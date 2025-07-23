@extends('auth.guest')
@section('title',  __('lang.Log in'))
@section('content')

    <div class="login-box">
      <div class="text-center mb-4">
        @include('session')
          <h2 class="">
             👋{{ __('lang.welcome')}}
          </h2>
          <span class="login-note">
            {{ __('lang.Please login here')}}
          </span>
        </div>
          <form method="POST" class="login-form-2" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <label class="form-label">{{ __('lang.email')}} </label>

                <input type="email" class="form-control" placeholder=" robertfox@example.com" value="{{old('email')}}" name="email" autofocus >

              </div>
              <div class="form-group">
                <label class="form-label"> {{ __('lang.password')}}  </label>

                <input type="password" class="form-input" name="password" placeholder="  ........... " >

              </div>
          <div class="forget-password-div">

            <label class="checkbox-div">
              <input  type="checkbox" name="remember">
              <span class="checkmark"></span>
              {{ __('lang.Remember me') }}
            </label>
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="forget-link">
               {{ __('lang.Forgot your password?') }}
              </a>
            @endif
          </div>
          <button type="submit" class="  reserve-link " >
            {{ __('lang.Log in') }}
          </button>
          <a href="{{route('register')}}"> {{__('lang.register')}}</a>
          </form>
      
    </div>


@endsection
