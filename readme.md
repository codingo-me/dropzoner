# Dropzoner - Laravel package for image upload using DropzoneJS 

[![Software License][ico-license]](https://github.com/codingo-me/dropzoner/blob/master/LICENSE)

This is the simplest Laravel package for image uploads using DropzoneJS. 

You pull it via composer, set service provider and include it in your views with **@include('dropzoner::dropzone')**. After this you need to set JS and CSS files in header and footer. 
Dropzone will take full width of parent container, and will throw events on image upload and image delete actions. 
Using event listeners you can hook this package with the rest of your application.

Package uses Image Intervention library for saving images. It has its own filename sanitizer and method for creating unique filenames inside upload directory.

## Guide

Require package in your Laravel project with:

```shell
composer require codingo-me/dropzoner
```

Now modify app.php config file and add Dropzoner Service Provider.

```php
        Codingo\Dropzoner\DropzonerServiceProvider::class
```
 
After setting service provider you need to publish Dropzoners configuration file and assets:

```shell
php artisan vendor:publish
```

When you publish these files, you will be able to modify Dropzoner configuration. There you'll find validator array and validator-messages array.

You also need to add upload path into .env file using key **DROPZONER_UPLOAD_PATH**. This directory should be write-able by web server, and it needs to end with trailing slash.

### Namespace

Package uses **Codingo\Dropzoner** namespace.

### Assets

In head section of your page add DropzoneJS stylesheet file.

```
<link rel="stylesheet" href="<?php echo asset('vendor/dropzoner/dropzone/dropzone.min.css'); ?>">
```

Above body closing tag add DropzoneJS JavaScript file, jQuery library and DropzoneJS custom configuration file. 
We are using jQuery file in custom configuration file, for AJAX requests to backend.

```
<script src="<?php echo asset('vendor/dropzoner/dropzone/dropzone.min.js'); ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo asset('vendor/dropzoner/dropzone/config.js'); ?>"></script>
```

### Including DropzoneJS upload widget

You can include DropzoneJS widget in your HTML with: 

```php
    @include('dropzoner::dropzone')
```

It will take full-width of parent div. That view consists of upload form and preview template. 

### Removal

By default each uploaded image will have **Remove** link. You can disable this feature once when you publish configuration file.

### Events

Idea behind this package is to have plug and play functionality, but you may need to hook upload and delete action with your application so we have 2 events.

* ImageWasUploaded
* ImageWasDeleted

**ImageWasUploaded** has 2 properties: $original_filename and $server_filename
**ImageWasDeleted** has 1 property: $server_filename

#### Example Listener

This is a simple listener for ImageWasUploaded events.

```php
<?php

namespace App\Listeners;

use Codingo\Dropzoner\Events\ImageWasUploaded;

class ImageUploadListener
{
    /**
     * Example listener for image uploads
     * Event carries original_filename
     * and server_filename
     *
     * @param ImageWasUploaded $event
     */
    public function handle(ImageWasUploaded $event)
    {
        \Log::info('Inside ImageUploadListener, image was uploaded: ' . $event->server_filename);
    }
}
```

## License

MIT License (MIT). See [License File](https://github.com/codingo-me/dropzoner/blob/master/LICENSE) for more information.


[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square