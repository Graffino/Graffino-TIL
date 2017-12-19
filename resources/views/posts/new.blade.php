@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <div class="container">
    <div class="form__wrapper">
      <h1>Create a new post</h1>
      {{ Form::open(['method' => 'POST', 'url' => ['posts/create']]) }}
          {{-- @include('articles.form') --}}
        <div class="form__field">
          {{ Form::label('title', 'Title', ['class' => 'form__label']) }}
          {{ Form::text('title', null, ['class' => 'form__input']) }}
        </div>
        <div class="form__field">
          {{ Form::label('body', 'Body', ['class' => 'form__label']) }}
          {{ Form::textarea('body', null, ['class' => 'form__textarea']) }}
        </div>
        <div class="form__field">
          {{ Form::label('select', 'Channel', ['class' => 'form__label']) }}
          {{ Form::select('channel_id', $channels, null, ['class' => 'h-float-left form__select']) }}
        </div>
        {{ Form::submit('Post', ['class' => 'button form__button']) }}
        {{ link_to('/', 'Cancel', ['class' => 'link form__link']) }}
      {{ Form::close() }}
    </div>
  </div>
@endsection
