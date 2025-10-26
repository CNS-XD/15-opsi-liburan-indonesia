<?php

use App\Models\ContactGeneral;
use App\Models\ContactSocmed;
use App\Models\Tahapan;
use App\Models\Theme;
use App\Models\Blog;
use App\Models\Faq;
use Illuminate\Support\Facades\Storage;

if (!function_exists('getInitials')) {
    function getInitials($name)
    {
        preg_match_all('/\b([A-Z])/', ucwords($name), $matches);
        return implode('', $matches[1]);
    }
}

if (!function_exists('generateUniqueSlugBlog')) {
    function generateUniqueSlugBlog($originalSlug, $id = null)
    {
        $query = Blog::where('slug', 'like', $originalSlug . '%');
        if ($id) {
            $query->where('id', '!=', $id); // Abaikan slug milik blog saat ini
        }
    
        $similarSlugs = $query->pluck('slug')->toArray();
    
        if (in_array($originalSlug, $similarSlugs)) {
            $counter = 2;
            while (in_array($originalSlug . '-' . $counter, $similarSlugs)) {
                $counter++;
            }
            return $originalSlug . '-' . $counter;
        }
    
        return $originalSlug;
    }
}

if (!function_exists('generateUniqueSlugFaq')) {
    function generateUniqueSlugFaq($originalSlug, $id = null)
    {
        $query = Faq::where('slug', 'like', $originalSlug . '%');
        if ($id) {
            $query->where('id', '!=', $id); // Abaikan slug milik faq saat ini
        }
    
        $similarSlugs = $query->pluck('slug')->toArray();
    
        if (in_array($originalSlug, $similarSlugs)) {
            $counter = 2;
            while (in_array($originalSlug . '-' . $counter, $similarSlugs)) {
                $counter++;
            }
            return $originalSlug . '-' . $counter;
        }
    
        return $originalSlug;
    }
}

if (!function_exists('normalizeHtmlContent')) {
    function normalizeHtmlContent($html)
    {
        if (empty(trim($html))) {
            return ''; // Atau bisa juga return null; tergantung kebutuhanmu
        }
        
        $dom = new \DomDocument();
        @$dom->loadHtml($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
        // Bersihkan format yang tidak penting
        $normalizedHtml = $dom->saveHTML();
    
        // Hapus whitespace yang tidak diperlukan
        $normalizedHtml = preg_replace('/\s+/', ' ', trim($normalizedHtml));
    
        return $normalizedHtml;
    }
}

if (!function_exists('deleteUnusedImages')) {
    function deleteUnusedImages($oldImages, $newImages)
    {
        $oldImages = explode(',', $oldImages);
        foreach ($oldImages as $oldImage) {
            if (!in_array($oldImage, $newImages)) {
                $relativePath = str_replace(request()->getSchemeAndHttpHost() . '/storage/', '', $oldImage);
                Storage::disk('public')->delete($relativePath); // Hapus file dari storage
            }
        }
    }
}

if (!function_exists('deleteAllImages')) {
    function deleteAllImages($images)
    {
        $images = explode(',', $images);
        foreach ($images as $image) {
            $relativePath = str_replace(request()->getSchemeAndHttpHost() . '/storage/', '', $image);
            Storage::disk('public')->delete($relativePath); // Hapus file dari storage
        }
    }
}

if (!function_exists('getYoutubeId')) {
    function getYoutubeId($link)
    {
        preg_match("#([\/|\?|&]vi?[\/|=]|youtu\.be\/|embed\/)([a-zA-Z0-9_-]+)#", $link, $matches);
        return end($matches);
    }
}

if (!function_exists('getColorTheme')) {
    function getColorTheme()
    {
        $data = Theme::first();
        return $data;
    }
}

if (!function_exists('getContactSocmed')) {
    function getContactSocmed($typeSocmed)
    {
        $data = ContactSocmed::where('type_socmed', $typeSocmed)
        ->first();
        return $data;
    }
}

if (!function_exists('getContactGeneral')) {
    function getContactGeneral()
    {
        $data = ContactGeneral::first();
        return $data;
    }
}

if (! function_exists('terbilang')) {
    function terbilang(int|float $number): string
    {
        // Pastikan extension intl aktif
        $formatter = new NumberFormatter('id', NumberFormatter::SPELLOUT);
        return $formatter->format($number);
    }
}