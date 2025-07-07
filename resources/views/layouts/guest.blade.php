<!DOCTYPE html>
<html
  x-data="{theme:localStorage.getItem('theme') || 'dark', dir:localStorage.getItem('dir') || 'rtl'}"
  x-bind:data-theme="theme"
  x-bind:dir="dir"
  x-bind:lang="dir==='rtl'? 'ar' :'en'"
>
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="{{asset('images/logos/Logo.svg')}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="pharma,pharmacies ."/>
    <title>{{__('lang.'.config('app.name'))}} - @yield('title')</title>

    @vite([
    'resources/css/app.css',
     'resources/src/style.css',
     'resources/src/assets/css/vars.css',
     'resources/src/assets/css/fonts.css',
     'resources/src/assets/css/containers.css',
     'resources/src/assets/css/custom.css',
     'resources/src/assets/css/main.css',
     'resources/src/assets/css/rtl.css',
     'resources/src/assets/css/styles.css',
     'resources/src/assets/css/responsive.css',

     'resources/src/assets/libs/material-icon/material-icon.css',
     'resources/js/app.js',
     'resources/src/main.js',
     'resources/src/js/home/ui-home.js'
    ])

  </head>
  <body class="bg-base">

    <!-- Start App Header -->
     @include('layouts.header')
    <!-- End App Header -->
    <main>

      @yield('content')
    </main>
    @include('layouts.footer')



  </body>
</html>
