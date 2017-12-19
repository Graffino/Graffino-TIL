<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Today I Learned - @yield('title')</title>
    <link rel="stylesheet" href="{{ URL::asset('/css/app.css') }}">
  </head>
  <body>
    <div class="app">
      <div style="display: none;">
        @include('layouts.svgs')
      </div>
      @include('ui.user')
      @include('ui.flash')
      <header class="hero">
        <div class="container">
          <h1 class="hero__title">Today I Learned</h1>
          <div class="hero__links">
            <a class="hero__subtitle" href="https://twitter.com/graffino">
              <span>
                <svg class="icon -size-small -twitter">
                  <use xlink:href="#sprite-twitter"/>
                </svg>
                Follow us on Twitter
              </span>
            </a>
          </div>
        </div>
      </header>
      <main class="main">
        @yield('content')
      </main>
      <aside class="sidebar">
        <nav class="nav">
          <ul>
            <li>
              <a class="link" id="search-button" href="#">
                <svg class="icon -size-medium -magnifier">
                  <use xlink:href="#sprite-magnifier"/>
                </svg>
              </a>
              <div id="search-bar" style="display: none;">
                {{ Form::open(['method' => 'get', 'url' => ['search']], ['class' => 'form']) }}
                  <input class="form__input nav__search-input" type="search" name="q">
                  {{ Form::submit('Search', ['class' => 'button nav__search-button']) }}
                {{ Form::close() }}
              </div>
            </li>
            <li>
              <a class="link" href="#">
                <svg class="icon -size-medium -question-mark">
                  <use xlink:href="#sprite-question-mark"/>
                </svg>
              </a>
            </li>
            <li>
              <a class="link" href="#">
                <svg class="icon -size-medium -line-chart">
                  <use xlink:href="#sprite-line-chart"/>
                </svg>
              </a>
            </li>
            <li>
              <a class="link" href="#">
                <svg class="icon -size-medium -twitter-white">
                  <use xlink:href="#sprite-twitter-white"/>
                </svg>
              </a>
            </li>
            <li>
              <a class="link" href="{{ url('random')}}">
                <svg class="icon -size-medium -dice">
                  <use xlink:href="#sprite-dice"/>
                </svg>
              </a>
            </li>
          </ul>
        </nav>
      </aside>
    </div>
    <script type="text/javascript" src="{{ URL::asset('/js/app.js') }}"></script>
  </body>
</html>
