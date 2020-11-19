<?php

namespace Dzorogh\OptimizedImage;

use Illuminate\Support\Facades\Log;
use League\Glide\Urls\UrlBuilderFactory;

class Picture {
    static function generate($src, array $data = null) {
        $height_ratio = null;

        $width = null;
        $height = null;

        if (isset($data['width'])) {
            $width = $data['width'];

            if (!isset($data['height'])) {
                $imageSize = getimagesize(storage_path(config('optimizedimage.source_folder') . $src));

                $imageSizeWidth = $imageSize[0];
                $imageSizeHeight = $imageSize[1];

                $height_ratio = $imageSizeHeight / $imageSizeWidth;

                $height = $width * $height_ratio;
            }
        }

        if (isset($data['height'])) {
            $height = $data['height'];

            if (!isset($data['width'])) {
                $imageSize = getimagesize(storage_path(config('optimizedimage.source_folder') . $src));

                $imageSizeWidth = $imageSize[0];
                $imageSizeHeight = $imageSize[1];

                $height_ratio = $imageSizeHeight / $imageSizeWidth;

                $width = $height / $height_ratio;
            }
        }

        if (!isset($data['width']) && !isset($data['height'])) {
            $imageSize = getimagesize(storage_path(config('optimizedimage.source_folder') . $src));

            $imageSizeWidth = $imageSize[0];
            $imageSizeHeight = $imageSize[1];

            $height_ratio = $imageSizeHeight / $imageSizeWidth;

            if ($imageSizeWidth > 1200) {
                $width = 1200;
            } else {
                $width = $imageSizeWidth;
            }

            $height = $width * $height_ratio;
        }


        return view('optimizedimage::picture', [
            'alt' => $data['alt'] ?? null,
            'src' => $src,
            'picture_classes' => $data['picture_classes'] ?? null,
            'img_classes' => $data['img_classes'] ?? null,
            'width' => round($width),
            'height' => round($height),
            'name' => $data['name'] ?? null,
            'type' => $data['type'] ?? null,
            'fit' => $data['fit'] ?? null,
            'lazy' => isset($data['lazy']) ? $data['lazy'] : true,
        ]);
    }

    static function makeUrl($src, $params = null)
    {
        $urlBuilder = UrlBuilderFactory::create('', 'secure-key');
//        $urlBuilder = UrlBuilderFactory::create('i', env('APP_KEY_128'));


        $path = pathinfo($src);

        if (isset($params['ratio'])) {

            if (isset($params['w']) && !isset($params['h'])) {
                if ($params['ratio'] == '16x9') {
                    $params['h'] = $params['w'] / (16 / 9);
                }
            }

            if (isset($params['h']) && !isset($params['w'])) {
                if ($params['ratio'] == '16x9') {
                    $params['w'] = $params['h'] * (16 / 9);
                }
            }
        }

        $resultingPath = '/i' . $path['dirname'] . '/' . $path['filename'] . '/' . urlencode(($params['name'] ?? config('optimizedimage.default_name'))) . '.' . $path['extension'];
        $resultingParams = [
            'q' => isset($params['preload']) ? 40 : 85,
            'blur' => isset($params['preload']) ? 100 : null,

            'h' => $params['h'] ?? null,
            'w' => $params['w'] ?? null,

            'fit' => $params['fit'] ?? 'crop',

            'dpr' => $params['dpr'] ?? 1,

            'fm' => $params['fm'] ?? 'webp',
            'bg' => $params['bg'] ?? null,
        ];




        $url = $urlBuilder->getUrl($resultingPath, $resultingParams);

        /*Log::info('Building Optimized Image Url', [
            'path' => $resultingPath,
            'params' => $resultingParams,
            'result_url' => $url
        ]);*/

        /*if (\Request::getHost() == 'ireparo.test') {
            return 'https://ireparo.ru' . $url;
        }*/

        return $url;
    }
}