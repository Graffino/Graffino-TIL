@extends('layouts.app')

@section('title', 'Edit '.$post->title)

@section('content')
  <div class="container">
    <h1>Edit post</h1>
    <form class="form" action="{{ route('posts.update', $post->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="form__field">
        <label class="form__label">Title</label>
        @if ($errors->has('title'))
          <span class="text -color-white">
            <strong>{{ $errors->first('title') }}</strong>
          </span>
        @endif
        <input class="form__input" type="text" name="title" value="{{ old('title', $post->title) }}">
      </div>
      <div class="form__field">
        <label class="form__label">Content</label>
        @if ($errors->has('body'))
          <span class="text -color-white">
            <strong>{{ $errors->first('body') }}</strong>
          </span>
        @endif
        <textarea id="editor" class="form__textarea" name="body">{{ old('body', $post->body) }}</textarea>
      </div>
      <div class="form__field">
        <label class="form__label">Channel</label>
        <select class="form__select" name="channel_id">
          @foreach ($channels as $key => $value)
            <option value="{{ $key }}" {{ ($key) == $post->channel_id ? 'selected' : '' }}>{{ $value }}</option>
          @foreach ($channels as $channel)
            <option value="{{ $channel['id'] }}" {{ ($channel['id']) == $post->channel_id ? 'selected' : '' }}>{{ $channel['name'] }}</option>
          @endforeach
        </select>
      </div>
      <div class="form__field h-center-text">
        <button class="button -color-white" type="submit">Update</button>
        <a class="link h-margin-left-1" href="{{ route('posts') }}">Cancel</a>
      </div>
    </form>
    <form class="form" action="{{ route('posts.destroy', $post->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <div class="form__field h-center-text">
        <button type="submit" class="button -color-white h-pull-right">Delete</button>
      </div>
    </form>
    <div id="html-preview"></div>
    <div id="editor-choice" data-choice="{{ Auth::user()->editor }}"></div>
  </div>
@endsection
