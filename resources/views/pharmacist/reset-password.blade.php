@extends('auth.guest')
@section('title',  __('lang.password_reset'))
@section('content')

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
        <h2 class="services-title fs-30 ">
           {{ __('lang.password_reset')}}
          </h2>
          <span class="login-note">
            <!-- يرجى إدخال التفاصيل -->
            {{ __('lang.update password')}}
          </span>
        </div>
        <form method="POST" action="{{ route('pharmacist.password.store') }}" class="p-4 rounded login-form-2">
  @csrf
  <input type="hidden" name="token" value="{{ $request->route('token') }}">

  <div class="form-group">
      <label class="text-light">{{ __('lang.email') }}</label>
      <input type="email" name="email"
             class="form-control bg-dark text-white border-secondary"
             placeholder="robertfox@example.com"
             value="{{ old('email', $request->email) }}">
  </div>

  <div class="form-group">
      <label class="text-light">{{ __('lang.password') }}</label>
      <input type="password" name="password"
             class="form-control bg-dark text-white border-secondary"
             placeholder="..........">
  </div>

  <div class="form-group">
      <label class="text-light">{{ __('lang.confirm_password') }}</label>
      <input type="password" name="password_confirmation" id="password_confirmation"
             class="form-control bg-dark text-white border-secondary"
             placeholder="..........">
  </div>

  <button type="submit" class="btn btn-login btn-block">
      {{ __('lang.Reset Password') }}
  </button>
</form>




    </div>


@endsection
