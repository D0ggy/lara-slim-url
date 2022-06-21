Lara Slim Url
==========================

## Introduction

A tool to shorten your url.

## Requirements


- PHP 7.0+
- Laravel >= 5.5.0



## Installing

Add the dependency to your project:

```bash
composer require d0ggy/lara-slim-url
```

Then publish resources using the `vendor:publish` command:
```bash
php artisan vendor:publish --provider="D0ggy\LaraSlimUrl\SlimUrlServiceProvider"
```

Next, you should migrate your database:
```bash
php artisan migrate
```


## Usage

```php
<?php
use D0ggy\LaraSlimUrl\Facades\SlimUrl;

$url = 'http://www.emard.org/harum-laborum-omnis-molestias-qui-tempora-iusto-est-maxime';
$path = SlimUrl::getSlimUrlPath($url);

echo url($path);die(0);
```

Open `http://localhost/s/{$path}` in browser, you will be redirect to `$url`.

