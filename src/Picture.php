<?php

namespace Dzorogh\OptimizedImage;

class Picture {
    static function generate($src, array $data = null) {
        $height_ratio = 1;

        if (isset($data['width']) && isset($data['height'])) {
            $height_ratio = $data['height'] / $data['width'];
        }

        return view('optimizedimage::picture', [
            'src' => $src,
            'picture_classes' => $data['picture_classes'] ?? null,
            'img_classes' => $data['img_classes'] ?? null,
            'width' => $data['width'] ?? null,
            'height' => $data['height'] ?? null,
            'name' => $data['name'] ?? null,
            'type' => $data['type'] ?? null,
            'fit' => $data['fit'] ?? null,
            'height_ratio' => $height_ratio,
            'lazy' => isset($data['lazy']) ? $data['lazy'] : true,
        ]);
    }
}