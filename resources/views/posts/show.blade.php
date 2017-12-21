@extends('layouts.app')

@section('title', $post->title)

@section('content')
  <div class="container">
    <div class="post">
      <div class="post__wrapper">
        <h1 class="post__title">{{ $post->title }}</h1>
        <p class="post__content">{!! markdown($post->body) !!}</p>
        <div class="post__info">
          <span class="post__author">{{ $post->developer->username }}</span>
          <span class="post__timestamp">{{ $post->created_at }}</span>
        </div>
      </div>
      <ul class="container--fluid">
        <li><a class="post__tag link" href="{{ url('channel/'.$post->channel->id)}}">{{ $post->channel->name }}</a></li>
        <li><a class="post__permalink link" href="/posts/{{ $post->slug }}">Permalink</a></li>
        <li><a class="post__raw link" href="#">Raw</a></li>
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
  </div>
@endsection
