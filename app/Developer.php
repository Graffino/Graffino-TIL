<?php

namespace App;

use App\Elegant;

class Developer extends Elegant
{
    protected $casts = [
      'admin' => 'boolean',
    ];

    protected $fillable = ['email', 'username', 'twitter_handle',];

    protected $rules = [
      'email' => 'required',
      'username' => 'required|email',
    ];

    public function cleanTwitterHandle () {
      return $this;
    }
}
