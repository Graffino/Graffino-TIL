@extends('layouts.app')

@section('title', 'New Post')

@section('content')
  <div class="container">
    <h1 class="h-align-center">Create a new post</h1>
    <form class="form" action="{{ route('posts.create') }}" method="post">
      {{ csrf_field() }}
      <div class="form__field">
        <label class="form__label">Title</label>
        @if ($errors->has('name'))
          <span class="text -color-white">
            <strong>{{ $errors->first('title') }}</strong>
          </span>
        @endif
        <input type="text" class="form__input" name="title" value={{ old('title') }}>
      </div>
      <div class="form__field">
        <label class="form__label">Content</label>
        @if ($errors->has('body'))
          <span class="text -color-white">
            <strong>{{ $errors->first('body') }}</strong>
          </span>
        @endif
        <textarea id="markdown-source" class="form__textarea" name="body">{{ old('body') }}</textarea>
      </div>
      <div class="form__field">
        <label class="form__label">Channel</label>
        <select class="form__select" name="channel_id">
          @foreach ($channels as $key => $value)
            <option value="{{ $key + 1 }}">{{ $value }}</option>
          @endforeach
        </select>
      </div>
      <div class="form__field h-center-text">
        <button class="button -color-white" type="submit">Post</button>
        <a class="link h-margin-left-1" href="{{ route('posts') }}">Cancel</a>
      </div>
    </form>
    <div id="html-preview"></div>
  </div>
@endsection
