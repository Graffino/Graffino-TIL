@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container">
  <div class="feed__wrapper">
    @foreach($posts as $post)
      <div class="post">
        <div class="post__wrapper">
          <h1 class="post__title">{{ $post->title }}</h1>
          <p class="post__content">{!! markdown($post->body) !!}</p>
          <div class="post__info">
            <span class="post__author">{{ $post->developer->username }}</span>
            <span class="post__timestamp">{{ $post->created_at->format('d M y') }}</span>
          </div>
        </div>
        <ul class="container--fluid">
          <li><a class="post__tag link" href="{{ url('channel/'.$post->channel->id) }}">{{ $post->channel->name }}</a></li>
          <li><a class="post__permalink link" href="{{ url('posts/'.$post->slug) }}">Permalink</a></li>
          <li><a class="post__raw link" href="{{ url('raw/'.$post->slug)}}">Raw</a></li>
          <li>
            <a class="post__like link" href="#">
              <svg class="icon -size-xsmall -heart">
                <use xlink:href="#sprite-heart"/>
              </svg>
              Like
            </a>
          </li>
        </ul>
      </div>
    @endforeach
  </div>
</div>
@endsection
