<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

  public function posts() {
    return $this->hasMany('App\Post');
  }
}
