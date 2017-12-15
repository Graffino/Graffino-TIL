@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <div class="feed__container">
    @foreach($posts as $post)
      <div class="post">
        <div class="post__container">
          <h1 class="post__title">{{ $post->title }}</h1>
          <p class="post__content">{{ $post->body }}</p>
          <div class="post__info">
            <span class="post__author"></span>
            <span class="post__timestamp">{{ $post->created_at }}</span>
          </div>
          <ul>
            <li><a href="#">{{ $post->channel->name }}</a></li>
          </ul>
        </div>  
      </div>
    @endforeach
  </div>
@endsection
