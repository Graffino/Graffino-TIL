@extends('layouts.blank')

@section('title', 'Raw - ' . $post->title)
@section('meta_keywords', $post->seo ?? '')
@section('description', $post->description ?? '')
@section('canonical_url', $post->canonical_url ?? '')
@section('social_image_url', $post->social_image_url ?? '')

<link rel="canonical" href="{{$post->canonical_url}}"/>

@section('content')
<pre style="word-wrap: break-word; white-space: pre-wrap;">
{{ $post->title }}

{{ $post->body }}

{{ $post->developer->username }}
{{ $post->created_at->format('d M Y') }}
</pre>

<a href="{{$post->canonical_url}}">&laquo; Back to post</a> 
@endsection
