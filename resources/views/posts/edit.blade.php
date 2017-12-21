@extends('layouts.app')

@section('title', 'Edit '.$post->title)

@section('content')
    <h1>Create a new post</h1>

    {{ Form::model($post, ['method' => 'PUT', 'url' => ['posts/'.$post->id.'/edit']]) }}
        {{-- @include('articles.form') --}}
      <div class="">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', $post->title) }}
      </div>
      <div class="">
        {{ Form::label('body', 'Body') }}
        {{ Form::text('body', $post->body) }}
      </div>
      <div class="">
        {{ Form::label('select', 'Channel') }}
        {{ Form::select('channel_id', $channels, $post->channel_id) }}
      </div>
      {{ Form::submit('Post') }}
      {{ link_to('/', 'Cancel') }}
    {{ Form::close() }}
@endsection
