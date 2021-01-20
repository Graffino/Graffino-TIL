<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Developer extends Authenticatable
{
    use HasFactory;

    protected $casts = [
      'admin' => 'boolean',
    ];

    protected $fillable = [
      'email', 'username', 'twitter_handle', 'editor',
    ];

    protected $hidden = [
      'remember_token',
    ];

    public function posts() {
      return $this->hasMany('App\Post');
    }

    public static function formatName(String $name) {
      return strtolower(preg_replace('/\s+/', '', $name));
    }

    public static function cleanTwitterHandle(String $handle) {
      if (is_string($handle) && $handle !== '') {
        return ltrim($handle, '@');
      }
    }

    public static function twitterHandle($id) {
      $developer = self::find($id);
      $handle = env('DEFAULT_TWITTER_HANDLE');

      if (!is_null($developer->twitter_handle)) {
        $handle = $developer->twitter_handle;
      }

      return $handle;
    }
}
