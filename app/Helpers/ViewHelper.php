<?php

namespace App\Helpers;

class ViewHelper
{
  static public function getCurrentUrl() {
    $url = request()->url(); 
    return str_replace('til.graffino.com', 'graffino.com/til', $url,);
  }
}
