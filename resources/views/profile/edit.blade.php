@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <h1> Hi, {{ $developer['email'] }}!</h1>

    {{ Form::model($developer, ['method' => 'PUT', 'url' => ['profile/edit']]) }}

        {{-- @include('articles.form') --}}
      <div class="">
        {{ Form::label('text', 'Twitter Handle') }}
        {{ Form::text('twitter_handle', $developer->twitter_handle) }}
      </div>
      <div class="">
        {{ Form::label('select', 'Editor') }}
        {{ Form::select('editor', ['Text Field' => 'Text Field', 'Vim' => 'Vim', 'Code Editor' => 'Code Editor'], $developer->editor) }}
      </div>
      {{ Form::submit('Update') }}
      {{ link_to('/', 'Cancel') }}
    {{ Form::close() }}
@endsection
