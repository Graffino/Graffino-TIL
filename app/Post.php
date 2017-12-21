<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
      'title', 'body', 'slug', 'likes', 'max_likes'. 'tweeted_at', 'developer_id', 'channel_id',
    ];

    public static $bodyMaxWords = 200;
    public static $titleMaxChars = 50;

    public function developer() {
      return $this->belongsTo('App\Developer');
    }

    public function channel() {
      return $this->belongsTo('App\Channel');
    }

    public static function slugifyTitle($title) {
      return str_slug($title, '-');
    }
    public static function saltSlug($slug) {
      $salt = substr(preg_replace('/[^A-Za-z0-9\s-]/', '' ,base64_encode(hex2bin(bin2hex(random_bytes(32))))), 0, 10);
      return $salt.'-'.$slug;
    }
}
