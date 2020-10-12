<?php

namespace Dzorogh\OptimizedImage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use League\Glide\Signatures\SignatureException;
use League\Glide\Signatures\SignatureFactory;

class ImageController extends Controller
{
    public function getOptimized($path)
    {
        Log::info('Getting optimized image', ['path' => $path, 'request-path' => \request()->path(), 'get' => $_GET, 'request-query' => \request()->query()]);

        $fullPath = '/' . request()->path();

        $query = request()->query();

        $sourceFolder = config('optimizedimage.source_folder');
        $cacheFolder = config('optimizedimage.cache_folder');

        $filePath = pathinfo($path);

        $filename = pathinfo($filePath['dirname'])['filename'];
        $dirname = pathinfo($filePath['dirname'])['dirname'];

        if (isset($filePath['extension'])) {
            $ext = $filePath['extension'];
        } else {
            return abort(404);
        }

        $src = $dirname . '/' . $filename . '.' . $ext;

        try {
            // Check key. Same key must be used when generating full url
            SignatureFactory::create(env('APP_KEY_128'))->validateRequest($fullPath, $query);

        } catch (SignatureException $e) {
            $error = [
                'src' => $src,
                'path' => $path,
                'request-path' => $fullPath,
                'get' => $_GET,
                'request-query' => request()->query(),
                'request-input' => request()->input(),
                'e' => $e
            ];

//            dd($error);

            Log::alert('Optimized Image signature check failed, returning original file.', $error);

            // On exception - return original image
            return response()->file(storage_path($sourceFolder) . '/' . $src);
        }

        // Setup Glide server
        $server = \League\Glide\ServerFactory::create([
            'source' => storage_path($sourceFolder),
            'cache' => storage_path($cacheFolder),
            'max_image_size' => 2000 * 2000,
            'defaults' => [
                'fm' => 'webp'
            ]
        ]);

        $server->outputImage($src, $_GET);

        exit;
    }
}
