<?php

use League\Glide\Urls\UrlBuilderFactory;

function optimized($src, $params = null)
{
    $urlBuilder = UrlBuilderFactory::create('i', env('APP_KEY_128'));

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

    $url = $urlBuilder->getUrl($path['dirname'] . '/' . $path['filename'] . '/' . urlencode(($params['name'] ?? config('optimizedimage.default_name'))) . '.' . $path['extension'], [

        'q' => isset($params['preload']) ? 40 : 85,
        'blur' => isset($params['preload']) ? 100 : null,

        'h' => $params['h'] ?? null,
        'w' => $params['w'] ?? null,

        'fit' => $params['fit'] ?? 'crop',

        'dpr' => $params['dpr'] ?? 1,

        'fm' => $params['fm'] ?? 'webp',
        'bg' => $params['bg'] ?? null,

    ]);

    /*if (\Request::getHost() == 'ireparo.test') {
        return 'https://ireparo.ru' . $url;
    }*/

    return $url;
}