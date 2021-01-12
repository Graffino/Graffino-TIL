<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use Notifiable;
    
    protected $fillable = [
      'title', 'body', 'slug', 'likes', 'max_likes'. 'tweeted_at', 'developer_id', 'channel_id', 'seo', 'description',
       'canonical_url', 'social_image_url'
    ];

    public static $bodyMaxWords = 200;
    public static $titleMaxChars = 50;

    public function routeNotificationForSlack()
    {
      return env('SLACK_POST_ENDPOINT');
    }

    public function developer()
    {
      return $this->belongsTo('App\Developer');
    }

    public function channel()
    {
      return $this->belongsTo('App\Channel');
    }

    public static function slugifyTitle($title)
    {
      return str_slug($title, '-');
    }
    public static function saltSlug($slug)
    {
      $salt = substr(preg_replace('/[^A-Za-z0-9\s-]/', '' ,base64_encode(hex2bin(bin2hex(random_bytes(32))))), 0, 10);
      return $salt.'-'.$slug;
    }
}
