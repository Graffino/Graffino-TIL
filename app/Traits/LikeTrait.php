<?php
namespace App\Traits;

use App\Post;

trait LikeTrait
{
  public function like($slug) {
    $post = Post::where('slug', '=', $slug)->firstOrFail();
    $likes = $post->likes + 1;
    $maxLikes = collect([$post->max_likes, $likes])->max();
    $maxLikesChanged = $maxLikes != $post->max_likes;

    Post::where('slug', '=', $slug)->update([
      'likes' => $likes,
      'max_likes' => $maxLikes,
    ]);

    return $likes;
  }

  public function unlike($slug) {
    $post = Post::where('slug', '=', $slug)->firstOrFail();
    $likes = $post->likes - 1;

    Post::where('slug', '=', $slug)->update(['likes' => $likes,]);

    return $likes;
  }
}
