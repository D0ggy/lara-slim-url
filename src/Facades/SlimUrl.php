<?php

namespace D0ggy\LaraSlimUrl\Facades;

use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Support\Facades\Facade;

/**
 * Class SlimUrl.
 *
 * @method static string randomStr($rawStrings = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', $allowDuplicates = false, $count = 6)
 * @method static \D0ggy\LaraSlimUrl\Models\SlimUrl|null generateSlimUrl($longUrl, $generateNewSlimUrl = false, $allowDuplicates = false)
 * @method static string getSlimUrlPath($longUrl, $generateNewSlimUrl = false, $allowDuplicates = false)
 * @method static HigherOrderBuilderProxy|mixed|string getOriginalUrl($short_url)
 *
 * @see \D0ggy\LaraSlimUrl\SlimUrl
 */
class SlimUrl extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \D0ggy\LaraSlimUrl\SlimUrl::class;
    }
}
