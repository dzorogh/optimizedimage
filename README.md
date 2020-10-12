# Optimized Image

* Show `<picture>` block with srcset and lazy-load params.
* Format to webp and resize image on server.

## How to use

Add to .env `APP_KEY_128` variable with some long key.

Required lazy load js plugin. 
https://github.com/verlok/vanilla-lazyload works great. 
Setup it to use .lazy class.

In your blade template:
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

The `picture` method returns HTML. It has `<picture>` tag with 2 sources: 
one for `png`/`jpg` type of image, and second with `webp`. 
And also default <img> tag with width and height. 

You must store your images in `/storage/app/public` folder. 
This package also creates  `/storage/app/cache` for cached resized variants

