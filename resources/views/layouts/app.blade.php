<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="domain-name" content="{{ env('APP_URL') }}">
    <meta name="keywords" content="@yield('meta_keywords', "graffino til, til, learning, today i learned , things i learned, learn, programming")">
    <meta name="description" content="@yield('description')">
    <link rel="canonical" href="@yield('canonical_url')"/>
    <meta name="og:title" content="@yield('title', "Today I Learned")"/>
    <meta name="og:url" content="@yield('canonical_url')" />
    <meta name="og:type" content="website" />
    <meta name="og:description" content="@yield('description')"/>

    <title>@yield('title') - Today I Learned</title>
    <link rel="stylesheet" href="{{ URL::asset('/css/app.css') }}">
  </head>
  <body>
    <div class="app">
      <div style="display: none;">
        @include('layouts.svgs')
      </div>
      @include('ui.flash')
      <header class="hero">
        @include('ui.user')
        <h1 class="hero__title"><a href="{{ route('posts') }}">Today I Learned</a></h1>
        <div class="hero__links">
          <a class="hero__subtitle" href="https://graffino.com">
              by
              <svg class="icon -logo">
                <use xlink:href="#sprite-logo"/>
              </svg>
          </a>
          <a class="hero__subtitle -color-twitter" href="https://twitter.com/graffinotil">
              <svg class="icon -size-small -twitter">
                <use xlink:href="#sprite-twitter"/>
              </svg>
              Follow us on Twitter
          </a>
        </div>
      </header>
      <main class="main">
        @yield('content')
      </main>
      <aside class="sidebar">
        <nav class="nav">
          <ul class="nav__list">
            <li class="nav__list-item js-toggle-container">
              <a class="nav__list-link js-toggle-button" href="#">
                <svg class="icon">
                  <use xlink:href="#sprite-magnifier"/>
                </svg>
              </a>
              <div id="search-bar" class="nav__search js-toggle-element">
                <form class="form" action="{{ route('search') }}" method="get">
                  <input class="nav__search-input" type="search" name="q">
                  <button class="nav__search-button" type="submit">Search</button>
                </form>
              </div>
            </li>
            <li class="nav__list-item js-toggle-container">
              <a class="nav__list-link js-toggle-button" href="#">
                <svg class="icon">
                  <use xlink:href="#sprite-question-mark"/>
                </svg>
              </a>
              <div class="popup js-toggle-element">
                Today I Learned is an open-source project by Graffino, inspired by <a class="link" style="color: #ae1f23;" href="https://hashrocket.com">Hashrocket</a> that exists to catalogue the sharing and accumulation of knowledge as it happens day-to-day. Posting is open to everyone at Graffino as well as selected friends of ours. We hope you enjoy learning along with us.
                <br>
                <br><a class="link -color-github" href="#">https://github.com/Graffino/</a>
                <br><a class="link -color-facebook" href="#">https://facebook.com/Graffino</a>
                <br><a class="link -color-twitter" href="#">https://twitter.com/Graffino</a>
              </div>
            </li>
            <li class="nav__list-item">
              <a class="nav__list-link" href="{{ route('stats') }}">
                <svg class="icon">
                  <use xlink:href="#sprite-line-chart"/>
                </svg>
              </a>
            </li>
            <li class="nav__list-item">
              <a class="nav__list-link" href="https://twitter.com/graffino">
                <svg class="icon">
                  <use xlink:href="#sprite-twitter-white"/>
                </svg>
              </a>
            </li>
            <li class="nav__list-item">
              <a class="nav__list-link" href="{{ route('random')}}">
                <svg class="icon">
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
