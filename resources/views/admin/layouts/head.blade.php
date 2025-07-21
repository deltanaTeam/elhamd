<!DOCTYPE html>

<html lang="en" @if(app()->getLocale() == 'ar') direction="rtl" style="direction: rtl;" @else direction="ltr" style="direction: 'ltr';" @endif >
<!--begin::Head-->

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}">


<head>

    <meta charset="utf-8"/>
    <title> {{config('app.name')}} - @yield('title')</title>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- <link rel="canonical" href="https://keenthemes.com/metronic"/> -->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->

    @if(app()->getLocale() == 'ar')

{{--RTL--}}
      <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtld1cf.css?v=7.1.6') }}" rel="stylesheet"  type="text/css"/>
      <link href="{{ asset('assets/plugins/global/plugins.bundle.rtld1cf.css?v=7.1.6') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.rtld1cf.css?v=7.1.6') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('assets/css/style.bundle.rtld1cf.css?v=7.1.6') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('assets/css/themes/layout/header/base/light.rtld1cf.css?v=7.1.6') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('assets/css/themes/layout/header/menu/light.rtld1cf.css?v=7.1.6') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('assets/css/themes/layout/brand/dark.rtld1cf.css?v=7.1.6') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('assets/css/themes/layout/aside/dark.rtld1cf.css?v=7.1.6') }}" rel="stylesheet" type="text/css"/>
  @else
{{--LTR--}}
khkyllkhl
      <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundled1cf.css?v=7.1.6')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('assets/plugins/global/plugins.bundled1cf.css?v=7.1.6" rel="stylesheet')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundled1cf.css?v=7.1.6')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('assets/css/style.bundled1cf.css?v=7.1.6" rel="stylesheet')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('assets/css/themes/layout/header/base/lightd1cf.css?v=7.1.6')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('assets/css/themes/layout/header/menu/lightd1cf.css?v=7.1.6')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('assets/css/themes/layout/brand/darkd1cf.css?v=7.1.6')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('assets/css/themes/layout/aside/darkd1cf.css?v=7.1.6')}}" rel="stylesheet" type="text/css"/>
      <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>

  @endif

    <link rel="shortcut icon" href="{{asset('site/images/logo.png')}}" type="image/png" >

    <!-- <link rel="shortcut icon"  href="https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/logos/favicon.ico"/> -->
    <!-- <link rel="shortcut icon" href="https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/logos/favicon.ico"/> -->
    @yield('style')
</head>
