@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container">
  <div class="feed__wrapper">
    @each('posts.partials.post', $posts, 'post', 'posts.partials.empty')
    {{ $posts->links() }}
  </div>
</div>
@endsection
