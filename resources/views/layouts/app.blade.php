<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Today I Learned - @yield('title')</title>
    <link rel="stylesheet" href="css/app.css">
    <!-- <style media="screen">
      body { margin: 0; }
      html, body, .app { height: 100%; }
      .app {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        grid-template-rows: 1fr 1fr 1fr 1fr;
      }
      header {
        grid-column: 1 / 5;
        grid-row: 1 / 5;
        background: yellow;
        text-align: center;
      }
      main {
        grid-column: 2 / 5;
        grid-row: 2 / 5;
        background: red;
      }
      aside {
        grid-column: 1 / 2;
        grid-row: 2 / 5;
        background: green;
      }
    </style> -->
  </head>
  <body>
    <div class="app">
      <div style="display: none;">
        @include('layouts.svgs')
      </div>
      @include('ui.user')
      @include('ui.flash')
      <header class="hero">
        <h1 class="hero__title">Today I Learned</h1>
        <a class="hero__subtitle" href="https://twitter.com/graffino">
          <span>
            <svg class="icon -size-small -twitter">
              <use xlink:href="#sprite-twitter"/>
            </svg>
            Follow us on Twitter
          </span>
        </a>
      </header>
      <main class="main">
        @yield('content')
      </main>
      <aside class="sidebar">
        <nav class="nav">
          <ul>
            <li>
              <a class="link" href="#">
                <svg class="icon -size-medium -magnifier">
                  <use xlink:href="#sprite-magnifier"/>
                </svg>
              </a>
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
                <svg class="icon -size-medium -twitter">
                  <use xlink:href="#sprite-twitter"/>
                </svg>
              </a>
            </li>
            <li>
              <a class="link" href="#">
                <svg class="icon -size-medium -dice">
                  <use xlink:href="#sprite-dice"/>
                </svg>
              </a>
            </li>
          </ul>
        </nav>
      </aside>
    </div>
  </body>
</html>
