<?php

namespace App;

use App\Elegant;

class Developer extends Elegant
{
    protected $casts = [
      'admin' => 'boolean',
    ];

    protected $fillable = [

    ];

    protected $rules = [
      'email' => 'required',
      'username' => 'required|email',
    ];
}
