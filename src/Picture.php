<?php

namespace Dzorogh\OptimizedImage;

use Illuminate\Support\Facades\Log;
use League\Glide\Urls\UrlBuilderFactory;

class Picture {
    static function generate($src, array $data = null) {
        $height_ratio = 0;

        if (isset($data['width']) && $data['width'] && isset($data['height']) && $data['height']) {
            $height_ratio = $data['height'] / $data['width'];
        }

        return view('optimizedimage::picture', [
            'src' => $src,
            'picture_classes' => $data['picture_classes'] ?? null,
            'img_classes' => $data['img_classes'] ?? null,
            'width' => $data['width'] ?? null,
//            'mobile_width' => $data['mobile_width'] ?? null,
            'height' => $data['height'] ?? null,
            'name' => $data['name'] ?? null,
            'type' => $data['type'] ?? null,
            'fit' => $data['fit'] ?? null,
            'height_ratio' => $height_ratio,
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