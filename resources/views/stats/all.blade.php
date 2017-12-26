@extends('layouts.app')

@section('title', 'Statistics')

@section('content')
<div class="container">
  <h1>Statistics</h1>

  <section>
    <h2>Last 30 days</h2>
    <div class="">
      <ul class="activity__chart">
        @foreach($postsForDays as $entry)
        <li class="activity__chart-item" data-amount={{ $entry->count }} data-date="{{ Carbon\Carbon::createFromFormat('Y-m-d', $entry->date)->format('D M y') }}">
          <div class="activity__chart-bar" style="height: {{ ($entry->count * 100) / $maxCount }}%;"></div>
        </li>
        @endforeach
      </ul>
    </div>
  </section>
</div>
@endsection
