<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="domain-name" content="{{ env('APP_URL') }}">
    <meta name="keywords" content="@hasSection('meta_keywords')@yield('meta_keywords')@else{{'graffino til, til, learning, today i learned , things i learned, learn, programming'}}@endif">
    <meta name="description" content="@hasSection('description')@yield('description')@else @yield('title'){{' • Learn new things everyday! Check out our latest tips and tricks.'}}@endif">
    <link rel="canonical" href="@hasSection('canonical_url')@yield('canonical_url')@else{{ViewHelper::getCurrentUrl()}}@endif">
    <meta name="og:title" content="@yield('title'){{' • Today I Learned'}}">
    <meta name="og:url" content="{{ViewHelper::getCurrentUrl()}}" >
    <meta name="og:type" content="website" >
    <meta name="og:description" content="@hasSection('description')@yield('description')@else @yield('title'){{' • Learn new things everyday! Check out our latest tips and tricks.'}}@endif">
    <meta name="og:image" content="@hasSection('social_image_url')@yield('social_image_url')@else{{asset('/images/post-image.png')}}@endif">

    <title>@yield('title'){{' • Today I Learned'}}</title>
  </head>
  <body>
    @yield('content')
  </body>
</html>
