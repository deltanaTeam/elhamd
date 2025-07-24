@extends('auth.guest')
@section('title',  __('lang.Log in'))
@section('content')
@section('guest-links')
<a href="{{route('pharmacist.register')}}" class="text-white p-5">{{__('lang.register')}}</a>

@endsection
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
          <form method="POST" class="" action="{{ route('pharmacist.login') }}">
              @csrf
              <div class="form-group">
                <label for="email" class="text-white">{{ __('lang.email')}} </label>

                <input type="email" class="form-control" placeholder=" robertfox@example.com" value="{{old('email')}}" name="email" autofocus >

              </div>
              <div class="form-group">
                <label for="password" class="text-white"> {{ __('lang.password')}}  </label>

                <input type="password" class="form-control" name="password" placeholder="  ........... " >

              </div>
          <div class="form-group d-flex justify-content-between align-items-center mb-4">

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                    <label class="custom-control-label text-muted" for="remember">
                        {{ __('lang.Remember me') }}
                    </label>
                </div>

                @if (Route::has('pharmacist.password.request'))
                    <a href="{{ route('pharmacist.password.request') }}" class="text-muted small">
                        {{ __('lang.Forgot your password?') }}
                    </a>
                @endif

            </div>

            <button type="submit" class="btn btn-login btn-block">
                {{ __('lang.Log in') }}
            </button>

          <a href="{{route('pharmacist.register')}}"> {{__('lang.register')}}</a>
          </form>

    </div>


@endsection
