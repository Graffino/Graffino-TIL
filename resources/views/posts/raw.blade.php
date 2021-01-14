@extends('layouts.blank')

@section('title', $post->title)
<link rel="canonical" href="{{$post->canonical_url}}"/>

@section('content')
<pre style="word-wrap: break-word; white-space: pre-wrap;">
{{ $post->title }}

{{ $post->body }}

{{ $post->developer->username }}
{{ $post->created_at->format('d M Y') }}
</pre>
@endsection
