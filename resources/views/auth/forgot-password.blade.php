@extends('auth.guest')
@section('title',  __('lang.forgot_password'))
@section('content')

    <div class="login-content">
      <div class="login-form-content">
        <a href="{{route('login')}}" class="forget-link mb-30">
          @if(app()->getLocale() == 'ar')
          <i class="fa-light fa-chevron-right"></i>
          @else
          <i class="fa-light fa-chevron-left"></i>
          @endif
         {{ __('lang.back')}}
         </a>
        <h2 class="services-title fs-30">
          <!-- نسيت كلمة المرور -->
          {{ __('lang.Forgot your password?')}}
          </h2>
          <span class="login-note">
            {{ __('lang.Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}

            <!-- أدخل عنوان بريدك الإلكتروني المسجل. سنرسل لك رمزًا لإعادة تعيين كلمة المرور الخاصة بك. -->
          </span>
          <form class="login-form-2" method="POST" action="{{ route('password.email') }}">
                @csrf
          <label class="form-label">
          {{ __('lang.email')}}
          </label>
          <input type="email" name="email" class="form-input" placeholder=" robertfox@example.com" value="{{old('email')}}" autofocus>


          <button type="submit" class="reserve-link ">
          <!-- إرسال رمز التحقق -->
          {{ __('lang.Email Password Reset Link') }}
          </button>
          </form>






      </div>
      <div class="login-img">
        <img class="img-responsive" src="{{asset('site/images/forget-password.png')}}" alt="forget password image">
      </div>
    </div>



@endsection
