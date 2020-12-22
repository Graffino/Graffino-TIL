<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Post;
use App\Developer;
use App\Channel;
use App\Notifications\PostCreated;
use App\Traits\LikeTrait;

use Debugbar;

class PostController extends Controller
{
    use LikeTrait;

    public function index()
    {
      $posts = Post::orderBy('created_at', 'desc')
        ->with(['channel', 'developer'])
        ->paginate(15);

      return view('posts.feed')->with('posts', $posts);
    }

    public function new()
    {
        $channels = $this->getChannels();

        return view('posts.new')->with('channels', $channels);
    }

    public function create(Request $request)
    {
      Validator::make($request->all(), [
        'title' => 'required|string',
        'body' => 'required|string',
        'channel_id' => 'required',
      ])->validate();

      $post = new Post();
      $post->title = $request->get('title');
      $post->body = $request->get('body');
      $post->channel_id = $request->get('channel_id');
      $post->slug = Post::saltSlug(Post::slugifyTitle($request->input('title')));
      $post->developer_id = Auth::id();

      if ($post->save()) {
			$post->notify(new PostCreated($post));
      }

      return redirect()->route('posts');
    }

    public function edit($id)
    {
        $channels = $this->getChannels();
        $post = Post::find($id);

        return view('posts.edit')
          ->with('post', $post)
          ->with('channels', $channels);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        Validator::make($request->all(), [
          'title' => 'required|string',
          'body' => 'required|string',
          'channel_id' => 'required',
        ])->validate();

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->channel_id = $request->input('channel_id');

        if ($post->update()) {
          $request->session()->flash('info', 'Post updated successfully!');
        } else {
          $request->session()->flash('info', 'Couldn\'t update the post!');
        }

        return redirect('/');
    }

    public function show($slug)
    {
      $post = Post::where('slug', '=', $slug)->firstOrFail();

      return view('posts.show')->with('post', $post);
    }

    public function destroy($id)
    {
      Post::destroy($id);

      return redirect()->route('posts')
        ->with('info', 'Post deleted!');
    }

    public function raw($slug)
    {
      $post = Post::where('slug', '=', $slug)->firstOrFail();

      return view('posts.raw')->with('post', $post);
    }

    public function random()
    {
      $post = Post::inRandomOrder()->first();

      return view('posts.show')->with('post', $post);
    }

    public function search(Request $request)
    {
      $q = $request->input('q');
      $posts = $this->searchPosts($q);

      return view('posts.feed')->with('posts', $posts);
    }

    protected function getChannels()
    {
      return Channel::all()
        ->map(function ($channel) {
          return $channel->only(['id', 'name']);
        })->all();
    }

    protected function searchPosts($q)
    {
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
