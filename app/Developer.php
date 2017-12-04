<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Developer extends Authenticatable
{
    protected $casts = [
      'admin' => 'boolean',
    ];

    protected $fillable = [
      'email', 'username', 'twitter_handle', 'editor',
    ];

    protected $hidden = [
      'remember_token',
    ];

    public static function findOrCreate (Array $attributes) {
      $email = $attributes['email'];
      $developer = Developer::where('email', $email)->first();


      return $developer ? $developer : Developer::create($attributes);
    }

    public static function formatName(String $name) {
      return strtolower(preg_replace('/\s+/', '', $name));
    }
}
