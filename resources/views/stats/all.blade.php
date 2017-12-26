@extends('layouts.app')

@section('title', 'Statistics')

@section('content')
<div class="container">
  <h1>Statistics</h1>

  <article>
    <h1>Last 30 days</h1>
    <div class="">
      <ul class="activity__chart">
        @foreach($postsForDays as $entry)
        <li class="activity__chart-item" data-amount={{ $entry->count }} data-date="{{ Carbon\Carbon::createFromFormat('Y-m-d', $entry->date)->format('D M y') }}">
          <div class="activity__chart-bar" style="height: {{ ($entry->count * 100) / $maxCount }}%;"></div>
        </li>
        @endforeach
      </ul>
    </div>
  </article>
  <article>
    <h1>Hottest Posts</h1>
      <ul class="post_list">
        @foreach($hottestPosts as $entry)
          <li>
            <a href="{{ url('posts/'.$entry->slug) }}">
              <b>
                {{ $entry->title }}
              </b>
              <small>
                {{ $entry->channel }}
                <span>•</span>
                {{ $entry->likes }} likes
              </small>
            </a>
          </li>
        @endforeach
  </article>
  <article>
    <h1>Most liked posts</h1>
      <ul class="list">
        @foreach($mostLikedPosts as $entry)
          <li class="list__item">
            <a class="link" href="{{ url('posts/'.$entry->slug) }}">
              <b>
                {{ $entry->title }}
              </b>
              <small>
                {{ $entry->channel }}
                <span>•</span>
                {{ $entry->likes }} likes
              </small>
            </a>
          </li>
        @endforeach
  </article>
  <article>
    <h1>{{ $postsCount }} posts in {{ $channelsCount }} channels</h1>
      <ul class="list">
        @foreach($channels as $channel)
          <li class="list__item">
            <a class="link" href="{{ url('channels/'.$channel->name) }}">
              <b>
                {{ $channel->name }}
              </b>
              <small>
                {{ $channel->count }} posts
              </small>
            </a>
          </li>
        @endforeach
  </article>
  <article>
    <h1>{{ $developersCount }} authors</h1>
      <ul class="post_list">
        @foreach($developers as $developer)
          <li>
            <a href="{{ url('author/'.$developer->username) }}">
              <b>
                {{ $developer->username}}
              </b>
              <small>
                {{ $developer->count }} posts
              </small>
            </a>
          </li>
        @endforeach
  </article>
</div>
@endsection
