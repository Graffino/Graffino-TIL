<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ChannelController extends Controller
{
    public function show($id) {
      $posts = Post::orderBy('created_at', 'desc')
                    ->where('channel_id', '=', $id)
                    ->paginate(5);

      return view('posts.feed')->with('posts', $posts);
    }
}
