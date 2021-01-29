<?php

namespace App\Helpers;

class ApplicationHelper
{
    public static function canonicalUrl($slug)
    {
        $appUrl = env("APP_URL");

        $url = $appUrl . '/' . $slug;
        $url = rtrim($url, '/');

        return $url;
    }
}
