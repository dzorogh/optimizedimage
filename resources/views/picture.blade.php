<picture class="{{ $picture_classes ?? '' }}">
    <source
            @if ($lazy)
                srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
            @endif

            {{ $lazy ? 'data-srcset' : 'srcset' }}="

                {{ optimized($src, [
                    'w' => $width,
                    'h' => $height_ratio ? $width * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => 'webp',
                    'dpr' => 0.25
                ]) }} 400w,

                {{ optimized($src, [
                    'w' => $width,
                    'h' => $height_ratio ? $width * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => 'webp',
                    'dpr' => 0.5
                ]) }} 800w,

                {{ optimized($src, [
                    'w' => $width,
                    'h' => $height_ratio ? $width * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => 'webp',
                    'dpr' => 0.75
                ]) }} 1400w,

                {{ optimized($src, [
                    'w' => $width,
                    'h' => $height_ratio ? $width * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => 'webp',
                    'dpr' => 1
                ]) }} 1800w"

            type="image/webp">

    <source
            @if ($lazy)
                srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
            @endif

            {{ $lazy ? 'data-srcset' : 'srcset' }}="

                {{ optimized($src, [
                    'w' => $width,
                    'h' => $height_ratio ? $width * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => $type ?? 'jpg',
                    'dpr' => 0.25
                ]) }} 400w,

                {{ optimized($src, [
                    'w' => $width,
                    'h' => $height_ratio ? $width * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => $type ?? 'jpg',
                    'dpr' => 0.5
                ]) }} 800w,

                {{ optimized($src, [
                    'w' => $width,
                    'h' => $height_ratio ? $width * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => $type ?? 'jpg',
                    'dpr' => 0.75
                ]) }} 1400w,

                {{ optimized($src, [
                    'w' => $width,
                    'h' => $height_ratio ? $width * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => $type ?? 'jpg',
                    'dpr' => 1
                ]) }} 1800w"

            type="image/{{ (!$type || $type === 'jpg') ? 'jpeg' : $type }}">

    <img
            @if ($lazy)
                src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
            @endif

            {{ $lazy ? 'data-src' : 'src' }}="{{
                optimized($src, [
                    'w' => $width ?? null,
                    'h' => $height ?? null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null
                 ]) }}"

            width="{{ $width ?? null}}"
            height="{{ $height ?? null}}"

            class="{{ $img_classes ?? null }} {{ $lazy ? 'lazy' : '' }}">
</picture>