@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <h1>Create a new post</h1>

    {{ Form::open(['method' => 'POST', 'url' => ['posts/create']]) }}
        {{-- @include('articles.form') --}}
      <div class="">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title') }}
      </div>
      <div class="">
        {{ Form::label('body', 'Body') }}
        {{ Form::text('body') }}
      </div>
      <div class="">
        {{ Form::label('select', 'Channel') }}
        {{ Form::select('channel_id', $channels) }}
      </div>
      {{ Form::submit('Post') }}
      {{ link_to('/', 'Cancel') }}
    {{ Form::close() }}
@endsection
