@extends('layouts.app')

@section('title', 'Statistics')

@section('content')
<div class="container">
  <h1 class="h-center-text">Statistics</h1>
  <div class="column is-12">
    <article class="tile"> 
      <h4 class="h-center-text">Last 30 days</h4> 
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
  </div>
  <div class="column is-12">
    <article>
      <h4 class="h-center-text">Hottest Posts</h4>
        <ul class="list -type-simple -type-tile">
          @foreach($hottestPosts as $entry)
            <li class="list__item">
              <a href="{{ route('posts.show', $entry->slug) }}" class="link">
                <b>
                  {{ $entry->title }}
                </b>
                <small class="h-pull-right">
                  {{ $entry->channel }}
                  <span>•</span>
                  {{ $entry->likes }} likes
                </small>
              </a>
            </li>
          @endforeach
    </article>
  </div>
  <div class="column is-12">
    <article>
      <h4 class="h-cenetr">Most liked posts</h4>
        <ul class="list -type-simple -type-tile">
          @foreach($mostLikedPosts as $entry)
            <li class="list__item">
              <a class="link" href="{{ route('posts.show', $entry->slug) }}">
                <b>
                  {{ $entry->title }}
                </b>
                <small class="h-pull-right">
                  {{ $entry->channel }}
                  <span>•</span>
                  {{ $entry->likes }} likes
                </small>
              </a>
            </li>
          @endforeach
    </article>
  </div>
  <div class="column is-6 is-12-tablet">
    <article>
      <h4 class="h-center-text">{{ $postsCount }} posts in {{ $channelsCount }} channels</h4>
        <ul class="list -type-simple -type-tile">
          @foreach($channels as $channel)
            <li class="list__item">
              <a class="link" href="{{ route('channel', $channel->id) }}">
                <b>
                  #{{ $channel->name }}
                </b>
                <small class="h-pull-right">
                  {{ $channel->count }} posts
                </small>
              </a>
            </li>
          @endforeach
    </article>
  </div>
  <div class="column is-6 is-12-tablet">
    <article>
      <h4 class="h-center-text">{{ $developersCount }} authors</h4>
        <ul class="list -type-simple -type-tile">
          @foreach($developers as $developer)
            <li class="list__item">
              <a href="{{ route('profile', $developer->username) }}" class="link">
                <b>
                  {{ $developer->username}}
                </b>
                <small class="h-pull-right">
                  {{ $developer->count }} posts
                </small>
              </a>
            </li>
          @endforeach
    </article>
  </div>
</div>
@endsection
