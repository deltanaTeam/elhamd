@extends('auth.guest')
@section('title',  __('lang.verification code'))
@section('content')
@section('guest-links')
<a href="{{route('pharmacist.login')}}" class="text-white p-5">{{__('lang.login')}}</a>

@endsection
<div class="login-box">
  <div class="text-center mb-4">
    @include('session')
    <a href="{{route('pharmacist.login')}}" class="forget-link mb-30">
      @if(app()->getLocale() == 'ar')
      <i class="fa-light fa-chevron-right"></i>
      @else
      <i class="fa-light fa-chevron-left"></i>
      @endif
     {{ __('lang.back')}}
     </a>

    <h2 class="services-title fs-30">
     <!-- أدخل رمز التحقق -->
     {{ __('lang.Send Verification Code')}}
      </h2>

      @if (session('status') == 'verification-link-sent')
      <span class="login-note">
        {{ __('lang.A new verification link has been sent to the email address you provided during registration.')}}
        <!-- لقد قمنا بمشاركة رمز على عنوان البريد الإلكتروني المسجل لديك -->
      </span>
      @endif
    </div>
    <div class="row justify-content-center text-center mb-4">

  <div class="col-lg-6 col-md-8 mb-2">
      <form method="POST" action="{{ route('pharmacist.verification.send') }}">
          @csrf
          <button type="submit" class="btn btn-warning btn-block btn-lg">
              {{ __('lang.Resend Verification Email') }}
          </button>
      </form>
  </div>

  <div class="col-lg-4 col-md-6">
      <form method="POST" action="{{ route('pharmacist.logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-light btn-block btn-lg">
              {{ __('lang.Log Out') }}
          </button>
      </form>
  </div>

</div>

</div>
@endsection
