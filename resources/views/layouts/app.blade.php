<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="domain-name" content="{{ env('APP_URL') }}">
    <meta name="keywords" content="@hasSection('meta_keywords')@yield('meta_keywords')@else{{'graffino til, learning, learn, code, programming, webdev, development, sysops'}}@endif">
    <meta name="description" content="@hasSection('description')@yield('description')@else@yield('title'){{'• TIL - Learn new things everyday! Check out our latest tips and tricks.'}}@endif">
    <link rel="canonical" href="@hasSection('canonical_url')@yield('canonical_url')@else{{ViewHelper::getCurrentUrl()}}@endif">
    <meta name="og:title" content="@yield('title'){{' • Today I Learned'}}">
    <meta name="og:url" content="{{ViewHelper::getCurrentUrl()}}">
    <meta name="og:type" content="website">
    <meta name="og:description" content="@hasSection('description')@yield('description')@else@yield('title'){{' • TIL - Learn new things everyday! Check out our latest tips and tricks.'}}@endif">
    <meta name="og:image" content="@hasSection('social_image_url')@yield('social_image_url')@else{{asset('/images/post-image.png')}}@endif">

    <title>@yield('title'){{' • Today I Learned'}}</title>
    @if (config('app.env') == 'local')
      <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    @else
      <link rel="stylesheet" href="{{URL::asset(mix('css/app.css'), true)}}">
    @endif
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
    @if (config('app.env') == 'local')
      <script src="{{URL::asset('js/app.js')}}"></script>
    @else
      <script src="{{URL::asset(mix('js/app.js'), true)}}"></script>
    @endif
  </body>
</html>
