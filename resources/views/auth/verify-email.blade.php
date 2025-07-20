@extends('auth.guest')
@section('title',  __('lang.verification code'))
@section('content')
<div class="login-content">
  <div class="login-form-content">
    @include('session')
    <a href="{{route('login')}}" class="forget-link mb-30">
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
      <div class="row col-12 " >
        <div class="col-lg-7 col-md-8 " style="margin-bottom:10px;">
          <form  method="POST" action="{{ route('verification.send') }}" >
             @csrf
             <button type="submit" class="btn btn-info btn-lg ">
                {{ __('lang.Resend Verification Email') }}
             </button>

          </form>
        </div>


        <div class="col-lg-4 col-md-3 " >
          <form  method="POST" action="{{ route('logout') }}" >
              @csrf

              <button type="submit" class="btn btn-primary btn-lg  ">
                    {{ __('lang.Log Out') }}
              </button>
          </form>
        </div>
     </div>
  </div>
  <div class="login-img">
    <img class="img-responsive" src="{{asset('site/images/verification-code.png')}}" alt="verification code image">
  </div>
</div>
@endsection
