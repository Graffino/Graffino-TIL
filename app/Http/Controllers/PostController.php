<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
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

        foreach ($posts as $post) {
            unset($post->seo);
            unset($post->canonical_url);
            unset($post->description);
        }

        return view('posts.index')->with('posts', $posts);
    }

    public function new()
    {
        $channels = $this->getChannels();

        return view('posts.new')->with('channels', $channels);
    }

    public function create(Request $request)
    {
        Validator::make($request->all(), [
        'post_title' => 'required|string',
        'body' => 'required|string',
        'channel_id' => 'required',
        ])->validate();

        $post = new Post();
        $post->title = $request->get('post_title');
        $post->body = $request->get('body');
        $meta_keywords = $request->get('meta_keywords');
        $keywords_array = explode(',', $meta_keywords);
        $keywords = ['keywords' => $keywords_array];
        $post->seo = json_encode($keywords);
        $post->description = $request->get('description');
        $post->channel_id = $request->get('channel_id');
        $post->social_image_url = $request->get('social_image_url');
        $post->slug = Post::saltSlug(Post::slugifyTitle($request->input('title')));
        $post->developer_id = Auth::id();
        $post->canonical_url = $request->get('canonical_url');

        if ($post->save()) {
            $post->notify(new PostCreated($post));
        }

        return redirect()->route('posts');
    }

    public function edit($id)
    {
        $channels = $this->getChannels();
        $post = Post::find($id);
        $seo = json_decode($post->seo);
        if (isset($seo->keywords)) {
            $post->seo = implode($seo->keywords, ",");
        }

        return view('posts.edit')
          ->with('post', $post)
          ->with('channels', $channels);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        Validator::make($request->all(), [
          'post_title' => 'required|string',
          'body' => 'required|string',
          'channel_id' => 'required',
        ])->validate();

        $post->title = $request->input('post_title');
        $post->body = $request->input('body');
        $post->channel_id = $request->input('channel_id');
        $keywords = $request->input('meta_keywords');
        $keywords_array = explode(',', $keywords);
        $keywords = ['keywords' => $keywords_array];
        $post->seo = json_encode($keywords);
        $post->canonical_url = $request->input('canonical_url');
        $post->description = $request->input('description');
        $post->social_image_url = $request->input('social_image_url');

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
        $seo = json_decode($post->seo);

        if (isset($seo->keywords)) {
            $post->seo = implode($seo->keywords, ",");
        }

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
        $post->canonical_url = env("APP_URL") . '/' . $post->slug;
        $seo = json_decode($post->seo);

        if (isset($seo->keywords)) {
            $post->seo = implode($seo->keywords, ",");
        }

        return view('posts.raw')->with('post', $post);
    }

    public function random()
    {
        $post = Post::inRandomOrder()->first();
        $seo = json_decode($post->seo);

        if (isset($seo->keywords)) {
            $post->seo = implode($seo->keywords, ",");
        }
        $post->canonical_url = env("APP_URL") . '/' . $post->slug;

        return view('posts.show')->with('post', $post);
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $posts = $this->searchPosts($q);

        foreach ($posts as $post) {
            unset($post->seo);
            unset($post->canonical_url);
            unset($post->description);
        }

        return view('posts.search')->with('posts', $posts);
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
