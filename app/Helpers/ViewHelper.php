<?php

namespace App\Helpers;

class ViewHelper
{
  public static function getCurrentUrl()
  {
        $url = str_replace('til.graffino.com/', 'graffino.com/til/', request()->url());
		$url = str_replace('til.graffino.com', 'graffino.com/til/', $url,);
        $url = str_replace('http:','https:', $url);
        return $url;
  }

  public static function getUrl($url)
  {
		$url = str_replace('til.graffino.com/', 'graffino.com/til', $url);
		$url = str_replace('til.graffino.com', 'graffino.com/til', $url,);
		$url = str_replace('http:','https:', $url);
		return $url;
  }
}
