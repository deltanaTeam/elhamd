<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
@if(app()->getLocale() == 'ar')
        <link href="{{ asset('assets/css/style.bundle.rtld1cf.css?v=7.1.6') }}" rel="stylesheet" type="text/css"/>
    @else
        <link href="{{asset('assets/css/style.bundled1cf.css?v=7.1.6" rel="stylesheet')}}" rel="stylesheet" type="text/css" />
@endif
        <!-- Scripts -->
        <style>
               body {
                   background-color: #1e1e2f;
                   color: #fff;
                   font-family: 'Cairo', sans-serif;
                   height: 100vh;
                   display: flex;
                   align-items: center;
                   justify-content: center;
               }

               .login-box {
                   background-color: #2c2c3e;
                   padding: 30px;
                   border-radius: 15px;
                   box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
                   width: 100%;
                   width: 500px;
                   max-width: 500px;
               }

               .form-control {
                   background-color: #3a3a4f;
                   color: #fff;
                   border: 1px solid #555;
               }

               .form-control:focus {
                   background-color: #3a3a4f;
                   color: #fff;
                   border-color: #777;
                   box-shadow: none;
               }

               .btn-login {
                   background-color: #6c63ff;
                   color: #fff;
                   border: none;
               }

               .btn-login:hover {
                   background-color: #574fd6;
               }

               .text-muted {
                   color: #aaa !important;
               }
           </style>
    </head>
    <body class="bg-dark">
        <div class="">

            <div class="  bg-dark  text-white ">
                @yield('content')
            </div>
        </div>
    </body>
</html>
