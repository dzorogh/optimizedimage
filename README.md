# Optimized Image

* Show `<picture>` block with srcset and lazy-load params.
* Format to webp and resize image on server.

## How to use

```blade
{!! \Dzorogh\OptimizedImage\Picture::generate('/image/path/inside/storage/app/public/folder.jpg', [
    'width' => 1200,
    'height' => 600,
    'type' => 'jpg',
    'img_classes' => 'img-fluid rounded',
    'picture_classes' => 'my-5',
    'name' => "Fake File Name"])
!!}
```

