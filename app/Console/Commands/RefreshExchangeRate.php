<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CurrencyService;

class RefreshExchangeRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:refresh {--force : Force refresh even if cache is valid}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh USD to IDR exchange rate from external APIs';

    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        parent::__construct();
        $this->currencyService = $currencyService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Refreshing USD to IDR exchange rate...');

        try {
            if ($this->option('force')) {
                $rate = $this->currencyService->refreshExchangeRate();
                $this->info('Exchange rate forcefully refreshed.');
            } else {
                $rate = $this->currencyService->getUsdToIdrRate();
                $this->info('Exchange rate retrieved (may use cache).');
            }

            $rateInfo = $this->currencyService->getExchangeRateInfo();
            
            $this->table(
                ['Property', 'Value'],
                [
                    ['Current Rate', $rateInfo['formatted_rate']],
                    ['Source', ucfirst($rateInfo['source'])],
                    ['Last Updated', $rateInfo['last_updated']->format('Y-m-d H:i:s')],
                ]
            );

            $this->info('Exchange rate refresh completed successfully!');
            
        } catch (\Exception $e) {
            $this->error('Failed to refresh exchange rate: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
