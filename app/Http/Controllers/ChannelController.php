<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Channel;

class ChannelController extends Controller
{
    public function show($name)
    {
        $channel = Channel::where('name', $name)
        ->first();

        $posts = Post::orderBy('created_at', 'desc')
                    ->where('channel_id', '=', $channel->id)
                    ->paginate(5);

        foreach ($posts as $post) {
            unset($post->seo);
            unset($post->canonical_url);
            unset($post->description);
        }

        return view('posts.feed')->with('posts', $posts);
    }
}
