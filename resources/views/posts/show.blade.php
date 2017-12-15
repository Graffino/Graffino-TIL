@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <div class="post"> 
    <h1 class="post__title">{{ $post->title }}</h1>
    <div class="post__content">
        {{ $post->title }}
    </div>
    <ul>
      <li><a href="#">{{ $post->channel->name }}</a></li>
    </ul>
  </div>
@endsection
