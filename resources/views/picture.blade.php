<picture class="{{ $picture_classes ?? '' }}">
    <source
            @if ($lazy)
                srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
            @endif

            {{ $lazy ? 'data-srcset' : 'srcset' }}="

            @if ($mobile_width)
                {{ optimized($src, [
                    'w' => $mobile_width,
                    'h' => $height_ratio ? $mobile_width * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => $type ?? 'jpg'
                ]) }} 320w,
            @endif

            {{ optimized($src, [
                'w' => $width,
                'h' => $height_ratio ? $width * $height_ratio : null,
                'name' => $name ?? null,
                'fit' => $fit ?? null,
                'fm' => $type ?? 'jpg'
            ]) }} 1280w"

            type="image/webp">

    <source
            @if ($lazy)
                srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
            @endif

            {{ $lazy ? 'data-srcset' : 'srcset' }}="
                @if ($mobile_width)
                    {{ optimized($src, [
                        'w' => $mobile_width,
                        'h' => $height_ratio ? $mobile_width * $height_ratio : null,
                        'name' => $name ?? null,
                        'fit' => $fit ?? null,
                        'fm' => $type ?? 'jpg'
                    ]) }} 320w,
                @endif

                {{ optimized($src, [
                    'w' => $width,
                    'h' => $height_ratio ? $width * $height_ratio : null,
                    'name' => $name ?? null,
                    'fit' => $fit ?? null,
                    'fm' => $type ?? 'jpg'
                ]) }} 1280w"

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