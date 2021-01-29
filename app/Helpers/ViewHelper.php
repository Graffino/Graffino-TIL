<?php

namespace App\Helpers;

class ViewHelper
{
    public static function getCurrentUrl()
    {
        $url = str_replace('til.graffino.com', 'graffino.com/til/', request()->url());
        $url = str_replace('http:', 'https:', $url);
        $url = preg_replace('/([^:])(\/{2,})/', '$1/', $url);
        $url = rtrim($url, '/');
        return $url;
    }

    public static function getUrl($url)
    {
        $url = str_replace('til.graffino.com', 'graffino.com/til/', request()->url());
        $url = str_replace('http:', 'https:', $url);
        $url = preg_replace('/([^:])(\/{2,})/', '$1/', $url);
        $url = rtrim($url, '/');
        return $url;
    }
}
