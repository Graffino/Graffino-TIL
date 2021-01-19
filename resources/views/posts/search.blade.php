@extends('layouts.app')

@section('title', 'Search')

@section('content')
<div class="container">
  <div class="feed__wrapper">
    @each('posts.partials.post', $posts, 'post', 'posts.partials.empty')
    @if( method_exists( $posts,'links' ) )
        {{ $posts->links() }}
    @endif
  </div>
</div>
@endsection
