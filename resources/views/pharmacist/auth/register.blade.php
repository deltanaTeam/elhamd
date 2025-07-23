@extends('auth.guest')
@section('title',  __('lang.register'))
@section('content')

    <div class="login-box">
      <div class="text-center mb-4">
        @include('session')
        <h2 class="services-title fs-30 ">
           {{ __('lang.Register')}}
          </h2>
          <span class="login-note">
            <!-- يرجى إدخال التفاصيل -->
            {{ __('lang.enter details')}}
          </span>
        </div>
        <form method="POST" action="{{ route('pharmacist.register') }}">
  @csrf

  <div class="form-group">
      <label class="text-light">{{ __('lang.username') }}</label>
      <input type="text" class="form-control bg-dark text-white border-secondary" name="name"
             placeholder="روبرت" value="{{ old('name') }}">
  </div>

  <div class="form-group">
      <label class="text-light">{{ __('lang.email') }}</label>
      <input type="email" class="form-control bg-dark text-white border-secondary" name="email"
             placeholder="robertfox@example.com" value="{{ old('email') }}">
  </div>

  <div class="form-group">
      <label class="text-light">{{ __('lang.password') }}</label>
      <input type="password" class="form-control bg-dark text-white border-secondary" name="password"
             placeholder="..........">
  </div>

  <div class="form-group">
      <label class="text-light">{{ __('lang.confirm_password') }}</label>
      <input type="password" class="form-control bg-dark text-white border-secondary" name="password_confirmation"
             id="password_confirmation" placeholder="..........">
  </div>

  <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="accept_rules" required>
      <label class="form-check-label text-light" for="accept_rules">
          {{ __('lang.accept_all_rule') }}
      </label>
  </div>

  <button type="submit" class="btn btn-login btn-block">
      {{ __('lang.register') }}
  </button>
</form>

    </div>


@endsection
