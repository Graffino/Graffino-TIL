<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Developer;
use App\Channel;
use Debugbar;

class PostController extends Controller
{
    public function index() {
      $posts = Post::all();

      return view('posts.feed', ['posts' => $posts,]);
    }

    public function new() {
        $channels = $this->getChannels();

        return view('posts.new', ['channels' => $channels,]);
    }

    public function create(Request $request) {
        $developerId = Auth::id();
        $request = $request->all();
        $slug = Post::saltSlug(Post::slugifyTitle($request['title']));

        $post = array_merge(
          $request,
          [
            'slug' => $slug,
            'developer_id' => $developerId,
          ]
        );

        Post::create($post);

        return redirect('/');
    }

    public function edit($id) {
        $channels = $this->getChannels();
        $post = Post::find($id);

        return view('posts.edit', ['post' => $post, 'channels' => $channels, ]);
    }

    public function update(Request $request, $id) {
        $post = Post::find($id);
        $post::update($request->all);

        return redirect('/');
    }

    private function getChannels() {
      $channelCollection = Channel::all();
      $channels = [];

      foreach ($channelCollection as $channel) {
        $pluckedChannel = $channel->only(['id', 'name']);
        $channelHash = [$pluckedChannel['id'] => $pluckedChannel['name']];
        $channels = array_merge($channels, $channelHash);
      }

      array_unshift($channels, '');
      unset($channels[0]);

      return $channels;
    }
}
