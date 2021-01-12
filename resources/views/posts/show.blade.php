@extends('layouts.app')

@section('title', $post->title)
@section('description', $post->description)

@section('content')
  <div class="container">
    <div class="feed__wrapper">
      @include('posts.partials.post')
      @includeIf('shared.'.$post->channel->name)
    </div>
  </div>
@endsection
