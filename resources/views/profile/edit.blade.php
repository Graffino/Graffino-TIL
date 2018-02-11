@extends('layouts.app')

@section('title', 'Profile')

@section('content')
  <div class="container">
    <h1 class="h-align-center"> Hi, {{ $developer['email'] }}!</h1>
    {{ Form::model($developer, ['method' => 'PUT', 'url' => ['profile/edit']]) }}
      <div class="form__field">
        {{ Form::label('twitter_handle', 'Twitter Handle', ['class' => 'form__label']) }}
        {{ Form::text('twitter_handle', $developer->twitter_handle, ['class' => 'form__input']) }}
      </div>
      <div class="form__field">
        {{ Form::label('editor', 'Editor', ['class' => 'form__label']) }}
        {{ Form::select('editor', ['Text Field' => 'Text Field', 'Vim' => 'Vim', 'Code Editor' => 'Code Editor'], $developer->editor, ['class' => 'form__select']) }}
      </div>
      <div class="form__field h-center-text">
        {{ Form::submit('Update', ['class' => 'button -color-white']) }}
        {{ link_to('/', 'Cancel', ['class' => 'link h-margin-left-1']) }}
      </div>
    {{ Form::close() }}
  </div>
@endsection
