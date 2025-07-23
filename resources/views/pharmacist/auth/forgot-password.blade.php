@extends('auth.guest')
@section('title',  __('lang.forgot_password'))
@section('content')

    <div class="login-box">
      <div class="text-center mb-4">
        <a href="{{route('pharmacist.login')}}" class="forget-link mb-30">
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
        </div>
        <form method="POST" action="{{ route('pharmacist.password.email') }}" class="p-4 rounded login-form-2">
  @csrf

  <div class="form-group">
      <label class="text-light">{{ __('lang.email') }}</label>
      <input type="email"
             name="email"
             class="form-control bg-dark text-white border-secondary"
             placeholder="robertfox@example.com"
             value="{{ old('email') }}"
             autofocus>
  </div>

  <button type="submit" class="btn btn-login btn-block">
      {{ __('lang.Email Password Reset Link') }}
  </button>
</form>








    </div>



@endsection
