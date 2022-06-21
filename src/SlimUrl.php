<?php

namespace D0ggy\LaraSlimUrl;

use Exception;
use Illuminate\Database\Eloquent\MassAssignmentException;

class SlimUrl
{
    protected $slimUrlModel;

    public function __construct()
    {
        $slimModel = config('slim_url.database.model');
        $this->slimUrlModel = new $slimModel;
    }

    /**
     * Generate specific length random string.
     *
     * @param  string  $rawStrings
     * @param  false  $allowDuplicates
     * @param  int  $count
     * @return string
     */
    public function randomStr($rawStrings = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', $allowDuplicates = false, $count = 6): string
    {
        if (empty($rawStrings)) {
            $rawStrings = config('slim_url.route.raw_string');
        }
        $strLength = mb_strlen($rawStrings);

        if (! $allowDuplicates && $strLength < $count) {
            throw new \LengthException(sprintf('Cannot get %d elements, only %d in strings', $count, $strLength));
        }

        $highKey = $strLength - 1;
        $keys = [];
        $elements = '';
        $numElements = 0;

        while ($numElements < $count) {
            $num = mt_rand(0, $highKey);

            if (! $allowDuplicates) {
                if (isset($keys[$num])) {
                    continue;
                }
                $keys[$num] = true;
            }

            $elements .= $rawStrings[$num];
            $numElements++;
        }

        return $elements;
    }

    /**
     * Get unique shorter path for url.
     *
     * @param $longUrl
     * @param  bool  $generateNewSlimUrl
     * @param  bool  $allowDuplicates
     * @return Models\SlimUrl|null
     *
     * @throws MassAssignmentException
     */
    public function generateSlimUrl($longUrl, $generateNewSlimUrl = false, $allowDuplicates = false)
    {
        if ($generateNewSlimUrl === false) {
            if ($this->slimUrlModel->where('url', $longUrl)->exists()) {
                return $this->slimUrlModel->where('url', $longUrl)->first();
            } else {
                return $this->generateSlimUrl($longUrl, true);
            }
        }

        $randStrings = $this->randomStr('', $allowDuplicates);
        if (! $this->slimUrlModel->where('slim_url', $randStrings)->exists()) {
            $slimUrl = $this->slimUrlModel->forceFill([
                'slim_url' => $randStrings,
                'url'      => $longUrl,
            ]);
            $slimUrl->save();

            return $slimUrl;
        }

        return $this->generateSlimUrl($longUrl, true);
    }

    /**
     * @param $longUrl
     * @param  false  $generateNewSlimUrl
     * @param  false  $allowDuplicates
     * @return string
     */
    public function getSlimUrlPath($longUrl, $generateNewSlimUrl = false, $allowDuplicates = false): string
    {
        $slimUrl = $this->generateSlimUrl($longUrl, $generateNewSlimUrl, $allowDuplicates);

        return config('slim_url.route.prefix')
            .'/'
            .$slimUrl->slim_url ?? '';
    }

    /**
     * Get original url.
     *
     * @param $short_url
     * @return string
     *
     * @throws Exception
     */
    public function getOriginalUrl($short_url): string
    {
        $slimUrl = $this->slimUrlModel
            ->where('slim_url', $short_url)
            ->first();

        if (is_null($slimUrl)) {
            throw new Exception("$short_url don't have correspond long url");
        }

        return $slimUrl->url ?? '/';
    }
}
