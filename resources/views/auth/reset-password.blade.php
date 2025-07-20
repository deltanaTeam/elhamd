@extends('auth.guest')
@section('title',  __('lang.password_reset'))
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
        <h2 class="services-title fs-30 ">
           {{ __('lang.password_reset')}}
          </h2>
          <span class="login-note">
            <!-- يرجى إدخال التفاصيل -->
            {{ __('lang.update password')}}
          </span>
          <form class="login-form-2" method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

          <label class="form-label">
            {{ __('lang.email')}}
          </label>
          <input type="email" class="form-input" placeholder=" robertfox@example.com" name="email" value="{{old('email', $request->email)}}" >

          <label class="form-label">
           {{ __('lang.password')}}
          </label>
          <input type="password"  name="password" class="form-input" placeholder="  ........... " >

          <label class="form-label">
           {{ __('lang.confirm_password')}}
          </label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="  ........... " >

          <button type="submit" class="reserve-link ">
              {{ __('lang.Reset Password') }}
          </button>
          </form>


      </div>
      <div class="login-img">
        <img class="img-responsive" src="{{asset('site/images/register.png')}}" alt="register image">
      </div>
    </div>


@endsection
