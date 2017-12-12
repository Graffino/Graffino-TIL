@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <h1>Posts</h1>
  @foreach($posts as $post)
    <div class="post"> 
      <h1 class="post__title">{{ $post->title }}</h1>
      <ul>
        <li><a href="#">{{ $post->channel->name }}</a></li>
      </ul>
    </div>
  @endforeach
@endsection
