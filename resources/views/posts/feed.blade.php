@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <div class="feed__wrapper">
    @foreach($posts as $post)
      <div class="post">
        <div class="container">
          <div class="post__wrapper">
            <h1 class="post__title">{{ $post->title }}</h1>
            <p class="post__content">{{ $post->body }}</p>
            <div class="post__info">
              <span class="post__author">{{ $post->developer->username }}</span>
              <span class="post__timestamp">{{ $post->created_at }}</span>
            </div>
            <ul>
              <li><a href="#">{{ $post->channel->name }}</a></li>
            </ul>
          </div>  
        </div>
      </div>
    @endforeach
  </div>
@endsection
