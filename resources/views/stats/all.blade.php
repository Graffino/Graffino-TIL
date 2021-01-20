@extends('layouts.app')

@section('title', 'Statistics')

@section('content')
<div class="container">
  <div class="columns">
    <h2 class="h-center">Statistics</h2>
    <div class="column -spans-12">
      <article class="tile">
        <h4 class="h-center">Last 30 days</h4>
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
    <div class="column -spans-12">
      <article>
        <h4 class="h-center">Hottest Posts</h4>
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
    <div class="column -spans-12">
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
    <div class="column -spans-6 -spans-12-tablet">
      <article>
        <h4 class="h-center">{{ $postsCount }} posts in {{ $channelsCount }} channels</h4>
        <ul class="list -type-simple -type-tile">
          @foreach($channels as $channel)
          <li class="list__item">
            <a class="link" href="{{ route('channel', $channel->name) }}">
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
    <div class="column -spans-6 -spans-12-tablet">
      <article>
        <h4 class="h-center">{{ $developersCount }} authors</h4>
        <ul class="list -type-simple -type-tile">
          @foreach($developers as $developer)
          <li class="list__item">
            <a href="{{ route('author', $developer->username) }}" class="link">
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
</div>
@endsection
