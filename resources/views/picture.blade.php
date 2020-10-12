<picture class="{{ $picture_classes ?? '' }}">
    <source
            @if ($lazy)
                srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
            @endif

            {{ $lazy ? 'data-srcset' : 'srcset' }}="

            {{ optimized($src, [
                'w' => 320,
                'h' => $height_ratio ? 320 * $height_ratio : null,
                'name' => $name ?? null,
                'fit' => $fit ?? null,
                'fm' => 'webp'
            ]) }} 320w,

            @if ($width && $width > (640 / 2))
            {{ optimized($src, [
                'w' => 640,
                'h' => $height_ratio ? 640 * $height_ratio : null,
                'name' => $name ?? null,
                'fit' => $fit ?? null,
                'fm' => 'webp'
            ]) }} 640w,
            @endif

            @if ($width && $width > 960 / 2)

            {{ optimized($src, [
                'w' => 960,
                'h' => $height_ratio ? 960 * $height_ratio : null,
                'name' => $name ?? null,
                'fit' => $fit ?? null,
                'fm' => 'webp'
            ]) }} 1280w,

            @endif

            @if ($width && $width > (1280 / 2))

            {{ optimized($src, [
                'w' => 1280,
                'h' => $height_ratio ? 1280 * $height_ratio : null,
                'name' => $name ?? null,
                'fit' => $fit ?? null,
                'fm' => 'webp'
            ]) }} 1280w,

            @endif

            @if ($width && $width > (1920 / 2))
            {{ optimized($src, [
                'w' => 1920,
                'h' => $height_ratio ? 1920 * $height_ratio : null,
                'name' => $name ?? null,
                'fit' => $fit ?? null,
                'fm' => 'webp'
            ]) }} 1920w,

            @endif
                    "

            type="image/webp">

    <source
            @if ($lazy)
                srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
            @endif

            {{ $lazy ? 'data-srcset' : 'srcset' }}="
                {{ optimized($src, [
                    'w' => 320,
                    'h' => $height_ratio ? 320 * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => $type ?? 'jpg'
                ]) }} 320w,

                @if ($width && $width > (640 / 2))
                {{ optimized($src, [
                    'w' => 640,
                    'h' => $height_ratio ? 640 * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => $type ?? 'jpg'
                ]) }} 640w,

                @endif

                @if ($width && $width > (960 / 2))
                {{ optimized($src, [
                    'w' => 960,
                    'h' => $height_ratio ? 960 * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => $type ?? 'jpg'
                ]) }} 1280w,
                @endif

                @if ($width && $width > (1280 / 2))
                {{ optimized($src, [
                    'w' => 1280,
                    'h' => $height_ratio ? 1280 * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => $type ?? 'jpg'
                ]) }} 1280w,
                @endif

                @if ($width && $width > (1920 / 2))
                {{ optimized($src, [
                    'w' => 1920,
                    'h' => $height_ratio ? 1920 * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => $type ?? 'jpg'
                ]) }} 1920w,
                @endif
            "

            type="image/{{ $type === 'jpg' ? 'jpeg' : $type }}">

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