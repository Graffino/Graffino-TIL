<?php

namespace App;

use App\Elegant;

class Developer extends Elegant
{
    protected $casts = [
      "public" => "boolean",
    ]:
    
    protected $rules = [
      "email" => "required",
      "username" => "required|email",
    ];
}
