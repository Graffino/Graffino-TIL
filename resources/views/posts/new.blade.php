@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <div class="container">
    <div class="form__wrapper">
      <h1>Create a new post</h1>
      {{ Form::open(['method' => 'POST', 'url' => ['posts/create']]) }}
          {{-- @include('articles.form') --}}
        <div class="form__field">
          {{ Form::label('title', 'Title') }}
          {{ Form::text('title') }}
        </div>
        <div class="form__field">
          {{ Form::label('body', 'Body') }}
          {{ Form::textarea('body') }}
        </div>
        <div class="form__field">
          {{ Form::label('select', 'Channel') }}
          {{ Form::select('channel_id', $channels) }}
        </div>
        {{ Form::submit('Post') }}
        {{ link_to('/', 'Cancel') }}
      {{ Form::close() }}
    </div>
  </div>
@endsection
