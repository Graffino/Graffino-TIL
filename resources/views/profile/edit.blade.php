@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <h1> My email is {{ $developer['email'] }} </h1>

    {!! Form::model($developer, ['method' => 'PATCH','route' => ['profile/edit']]) !!}
        {{-- @include('articles.form') --}}
    {!! Form::close() !!}
@endsection
