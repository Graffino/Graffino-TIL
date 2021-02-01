@extends('layouts.blank')

@section('title', $post->title)
@section('meta_keywords', $post->seo ?? '')
@section('description', $post->description ?? '')
@section('canonical_url', $post->canonical_url ?? '')
@section('social_image_url', $post->social_image_url ?? '')

@section('content')
<h1>{{ $post->title }}</h1>

<pre style="word-wrap: break-word; white-space: pre-wrap;">
{{ $post->body }}

{{ $post->developer->username }}
{{ $post->created_at->format('d M Y') }}
</pre>

<a href="{{$post->canonical_url}}">&laquo; Back to post</a>
@endsection
