<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use SSH;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    

    public function __construct()
    {
        
    }

    public function iterateImage($editor, $module)
    {
        $baseUrl = request()->getSchemeAndHttpHost();
        $dom = new \DomDocument();
        @$dom->loadHtml($editor, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        $arrImages = [];
    
        // Pastikan direktori sudah ada, ini bisa dilakukan sekali di luar loop
        if (!Storage::disk('public')->exists($module)) {
            Storage::disk('public')->makeDirectory($module);
        }
    
        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');
    
            // Check image base64
            if (stripos($data, "data:image") !== false) {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = uniqid() . $k . '.png';
                
                // Cek apakah image sudah ada di storage, jika sudah lewati
                if (!Storage::disk('public')->exists($module . '/' . $image_name)) {
                    File::put(storage_path('app/public/' . $module . '/') . $image_name, $data);
                }
    
                $img->removeAttribute('src');
                $imageUrl = $baseUrl . "/storage/" . $module . "/" . $image_name;
                $img->setAttribute('src', $imageUrl);
    
                $arrImages[] = $imageUrl; // Simpan URL image ke array
    
            } elseif (filter_var($data, FILTER_VALIDATE_URL)) {
                // Cek apakah image dari URL eksternal, jika sudah ada di storage lewati
                $image_name = basename(parse_url($data, PHP_URL_PATH));
                if (!Storage::disk('public')->exists($module . '/' . $image_name)) {
                    $imageContent = file_get_contents($data); // Lebih cepat daripada cURL
                    
                    if ($imageContent === false) {
                        Log::error("Failed to fetch image from URL: " . $data);
                        continue;
                    }
    
                    File::put(storage_path('app/public/' . $module . '/' . $image_name), $imageContent);
                }
    
                $img->removeAttribute('src');
                $imageUrl = $baseUrl . "/storage/" . $module . "/" . $image_name;
                $img->setAttribute('src', $imageUrl);
    
                $arrImages[] = $imageUrl; // Simpan URL image ke array
            } else {
                // Jika bukan base64 atau URL, abaikan atau gunakan URL asli
                $arrImages[] = $data;
            }
        }
    
        return [$arrImages, $dom];
    }

    public function clearImage($imagePost = [], $id = '', $model, $module, $isDelete = false)
    {
        $dbImages = $model->find($id)->image ?? null;

        if (!empty($imagePost)) {
            if (!empty($dbImages)) {
                $dbImages = explode(",", $dbImages);
                if ($isDelete) {
                    foreach ($imagePost as $key => $file) {
                        if (is_file(storage_path("app/public/" . $module . "/" . $file)))
                            Storage::disk('public')->delete($module . '/' . $file);
                    }
                } else {
                    $excludes = array_values(array_diff($dbImages, $imagePost));
                    foreach ($excludes as $key => $file) {
                        if (is_file(storage_path("app/public/" . $module . "/" . $file)))
                            Storage::disk('public')->delete($module . '/' . $file);
                    }
                }
            }

            return true;
        }
    }

    public function uploadFile($file, $path)
    {
        $path = Storage::disk('public')->put($path, $file);
        return $path;
    }

    public function removeFile($pathImage)
    {
        $path = null;
        if (Storage::disk('public')->exists($pathImage)) {
            $path = Storage::disk('public')->delete($pathImage);
            return $path;
        }

        return $path;
    }
}
