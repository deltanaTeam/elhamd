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
                   border-radius: 0px 0px 15px 15px;
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

              <div class="dropdown  rounded-top row" style="height:90%;background-color: #3f3f5a; ">
                  <!--begin::Toggle-->
                  <div class="topbar-item  col-6  white"  >

                    <div class=" btn btn-block  btn-lg   text-white" >
                      @yield('guest-links')
                    </div>
                  </div>
                  <div class="topbar-item col-6  " data-toggle="dropdown" >
                      <div class=" col-12 btn btn-block   btn-dropdown btn-lg  text-white">
                          <i class="fa fa-flag"></i>{{app()->getLocale()}}
                      </div>

                  </div>


                  <!--end::Toggle-->
                  <!--begin::Dropdown-->
                  <div
                      class="dropdown-menu t p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-left">
                      <!--begin::Nav-->
                      <ul class="navi navi-hover py-4">

                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                         <li class="navi-item">
                          <a rel="alternate" class="navi-link"  hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                            <span class="navi-text">  {{ $properties['native'] }} </span>

                          </a>
                      </li>
                        @endforeach
                         <!--end::Item-->
                      </ul>
                      <!--end::Nav-->
                  </div>
                  <!--end::Dropdown-->
              </div>
                @yield('content')
            </div>
        </div>
        <script src="{{asset('assets/plugins/global/plugins.bundled1cf.js?v=7.1.6')}}"></script>
        <script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundled1cf.js?v=7.1.6')}}"></script>
        <script src="{{asset('assets/js/scripts.bundled1cf.js?v=7.1.6')}}"></script>
    </body>
</html>
