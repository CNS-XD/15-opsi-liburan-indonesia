<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CurrencyService
{
    protected $apiKey;
    protected $baseUrl;
    protected $fallbackRate;

    public function __construct()
    {
        $this->apiKey = config('services.exchange_rate.api_key');
        $this->baseUrl = config('services.exchange_rate.base_url', 'https://api.exchangerate-api.com/v4/latest');
        $this->fallbackRate = config('services.exchange_rate.fallback_rate', 17100); // Default 17100 jika tidak diset
    }

    /**
     * Get USD to IDR exchange rate
     */
    public function getUsdToIdrRate()
    {
        // Cache key untuk exchange rate
        $cacheKey = 'exchange_rate_usd_idr';
        
        // Cek cache dulu (cache selama 1 jam)
        $cachedRate = Cache::get($cacheKey);
        if ($cachedRate) {
            return $cachedRate;
        }

        try {
            // Coba beberapa API exchange rate
            $rate = $this->tryMultipleApis();
            
            if ($rate) {
                // Cache rate selama 6 jam (untuk mengurangi API calls)
                Cache::put($cacheKey, $rate, 21600);
                return $rate;
            }
            
        } catch (\Exception $e) {
            Log::warning('Currency API failed: ' . $e->getMessage());
        }

        // Jika semua API gagal, gunakan fallback rate
        Log::info('Using fallback exchange rate: ' . $this->fallbackRate);
        return $this->fallbackRate;
    }

    /**
     * Try multiple exchange rate APIs
     */
    private function tryMultipleApis()
    {
        $apis = [
            'exchangerate-api' => function() {
                return $this->getFromExchangeRateApi();
            },
            'fixer' => function() {
                return $this->getFromFixerApi();
            },
            'currencylayer' => function() {
                return $this->getFromCurrencyLayerApi();
            },
            'free-api' => function() {
                return $this->getFromFreeApi();
            }
        ];

        foreach ($apis as $apiName => $apiFunction) {
            try {
                $rate = $apiFunction();
                if ($rate && $rate > 0) {
                    Log::info("Exchange rate obtained from {$apiName}: {$rate}");
                    return $rate;
                }
            } catch (\Exception $e) {
                Log::warning("API {$apiName} failed: " . $e->getMessage());
                continue;
            }
        }

        return null;
    }

    /**
     * Get rate from ExchangeRate-API (Free)
     */
    private function getFromExchangeRateApi()
    {
        $response = Http::timeout(10)->get('https://api.exchangerate-api.com/v4/latest/USD');
        
        if ($response->successful()) {
            $data = $response->json();
            return $data['rates']['IDR'] ?? null;
        }
        
        return null;
    }

    /**
     * Get rate from Fixer.io (Requires API key)
     */
    private function getFromFixerApi()
    {
        $apiKey = config('services.fixer.api_key');
        if (!$apiKey) {
            return null;
        }

        $response = Http::timeout(10)->get('http://data.fixer.io/api/latest', [
            'access_key' => $apiKey,
            'base' => 'USD',
            'symbols' => 'IDR'
        ]);
        
        if ($response->successful()) {
            $data = $response->json();
            return $data['rates']['IDR'] ?? null;
        }
        
        return null;
    }

    /**
     * Get rate from CurrencyLayer (Requires API key)
     */
    private function getFromCurrencyLayerApi()
    {
        $apiKey = config('services.currencylayer.api_key');
        if (!$apiKey) {
            return null;
        }

        $response = Http::timeout(10)->get('http://api.currencylayer.com/live', [
            'access_key' => $apiKey,
            'currencies' => 'IDR',
            'source' => 'USD'
        ]);
        
        if ($response->successful()) {
            $data = $response->json();
            return $data['quotes']['USDIDR'] ?? null;
        }
        
        return null;
    }

    /**
     * Get rate from free API (backup)
     */
    private function getFromFreeApi()
    {
        $response = Http::timeout(10)->get('https://open.er-api.com/v6/latest/USD');
        
        if ($response->successful()) {
            $data = $response->json();
            return $data['rates']['IDR'] ?? null;
        }
        
        return null;
    }

    /**
     * Convert USD to IDR
     */
    public function convertUsdToIdr($usdAmount)
    {
        $rate = $this->getUsdToIdrRate();
        return $usdAmount * $rate;
    }

    /**
     * Convert IDR to USD
     */
    public function convertIdrToUsd($idrAmount)
    {
        $rate = $this->getUsdToIdrRate();
        return $idrAmount / $rate;
    }

    /**
     * Get formatted exchange rate info
     */
    public function getExchangeRateInfo()
    {
        $rate = $this->getUsdToIdrRate();
        $lastUpdated = Cache::get('exchange_rate_usd_idr_updated', now());
        
        return [
            'rate' => $rate,
            'formatted_rate' => 'Rp ' . number_format($rate, 0, ',', '.'),
            'last_updated' => $lastUpdated,
            'source' => $rate == $this->fallbackRate ? 'fallback' : 'api'
        ];
    }

    /**
     * Force refresh exchange rate
     */
    public function refreshExchangeRate()
    {
        Cache::forget('exchange_rate_usd_idr');
        Cache::put('exchange_rate_usd_idr_updated', now());
        return $this->getUsdToIdrRate();
    }

    /**
     * Get historical rates (if needed)
     */
    public function getHistoricalRate($date)
    {
        try {
            $response = Http::timeout(10)->get("https://api.exchangerate-api.com/v4/history/USD/{$date}");
            
            if ($response->successful()) {
                $data = $response->json();
                return $data['rates']['IDR'] ?? $this->fallbackRate;
            }
        } catch (\Exception $e) {
            Log::warning('Historical rate API failed: ' . $e->getMessage());
        }
        
        return $this->fallbackRate;
    }
}