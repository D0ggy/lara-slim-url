Lara Slim Url
==========================

<p align="center">
<a href="https://github.com/D0ggy/lara-slim-url/actions"><img src="https://github.com/D0ggy/lara-slim-url/workflows/tests/badge.svg" alt="Build Status"></a>
<img alt="Packagist Downloads" src="https://img.shields.io/packagist/dt/D0ggy/lara-slim-url">
<img alt="Packagist License" src="https://img.shields.io/packagist/l/D0ggy/lara-slim-url">
<a href="https://github.styleci.io/repos/505718370?branch=0.1.0-alpha"><img src="https://github.styleci.io/repos/505718370/shield?branch=0.1.0-alpha" alt="StyleCI"></a>
<img alt="Packagist Version" src="https://img.shields.io/packagist/v/D0ggy/lara-slim-url">
</p>

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

