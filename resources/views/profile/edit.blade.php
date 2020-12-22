@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <div class="container">
    <h1 class="h-align-center"> Hi, {{ $developer->email }}!</h1>
    <form class="form" action="{{ route('profile.edit') }}" method="post">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="form__field">
        <label class="form__label">Twitter handle</label>
        @if ($errors->has('twitter_handle'))
          <span class="text -color-white">
            <strong>{{ $errors->first('twitter_handle') }}</strong>
          </span>
        @endif
        <input class="form__input" type="text" name="twitter_handle" value="{{ old('twitter_handle', $developer->twitter_handle) }}">
      </div>
      <div class="form__field">
        <label class="form__label">Editor</label>
        <select class="form__select" name="editor">
          @foreach ($editorOptions as $value)
            <option value="{{ $value }}" {{ $value == $developer->editor ? 'selected' : '' }}>{{ $value }}</option>
          @endforeach
        </select>
      </div>
      <div class="form__field h-center">
        <button class="button -color-white" type="submit">Update</button>
        <a class="link h-margin-left-10" href="{{ route('posts') }}">Cancel</a>
      </div>
    </form>
  </div>
@endsection
