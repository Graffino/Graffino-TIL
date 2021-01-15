<?php

namespace App\Helpers;

class ViewHelper
{
  static public function getCurrentUrl() {
    $url = request()->url(); 
    $domain = str_replace('til.graffino.com/', 'graffino.com/til', $url,);
    $secureUrl = str_replace('http:','https:', $domain);
    return $secureUrl;
  }
}
