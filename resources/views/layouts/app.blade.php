<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Today I Learned - @yield('title')</title>
    
    <style media="screen">
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
    </style>
  </head>
  <body>
    <div class="app">
      <header class="hero">
        <h1 class="hero__title">Today I Learned</h1>
        <div class="hero__subtitle">Follow us on Twitter</div>
      </header>
      <main class="main">
        @yield('content')
      </main>
      <aside class="sidebar">
          <ul>
            <li>Search</li>
            <li>About</li>
            <li>Statistics</li>
            <li>Twitter</li>
            <li>Random</li>
          </ul>
      </aside>
    </div>
  </body>
</html>
