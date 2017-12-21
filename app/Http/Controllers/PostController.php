<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Developer;
use App\Channel;
use Debugbar;

class PostController extends Controller
{
    public function index() {
      $posts = Post::orderBy('created_at', 'desc')->get();

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

    public function show($slug) {
      $post = Post::where('slug', '=', $slug)->firstOrFail();

      return view('posts.show', ["post" => $post]);
    }

    public function raw($slug) {
      $post = Post::where('slug', '=', $slug)->firstOrFail();

      return view('posts.raw', ["post" => $post]);
    }

    public function random() {
      $post = Post::all()->random(1)->first();

      return view('posts.show', ["post" => $post]);
    }

    public function search(Request $request) {
      $q = $request->input('q');
      $posts = $this->searchPosts($q);
      Debugbar::info($posts);
      return view("posts.feed", ['posts' => $posts]);
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

    private function searchPosts($q) {
      $results = DB::select("select p.* from posts p
      left join developers d on d.id = p.developer_id
      left join channels c on c.id = p.channel_id
      join lateral (
        select ts_rank_cd( setweight(to_tsvector('english', p.title), 'A')
        || setweight(to_tsvector('english', d.username), 'B')
        || setweight(to_tsvector('english', c.name), 'B')
        || setweight(to_tsvector('english', p.body), 'C'), plainto_tsquery('english', '".$q."')) as rank)
        ranks on true
        where ranks.rank > 0 order by ranks.rank desc, p.created_at desc");

      return Post::hydrate($results);
    }
}
