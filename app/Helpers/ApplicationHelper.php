<?php

namespace App\Helpers;

class ApplicationHelper
{
  static public function canonicalUrl($slug) {
    $appUrl = env("APP_URL");

    return $appUrl.$slug;
  }
}
