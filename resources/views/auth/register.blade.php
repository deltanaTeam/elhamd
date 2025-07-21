@extends('auth.guest')
@section('title',  __('lang.register'))
@section('content')

    <div class="login-content">
      <div class="login-form-content">
        @include('session')
        <h2 class="services-title fs-30 ">
           {{ __('lang.Register')}}
          </h2>
          <span class="login-note">
            <!-- يرجى إدخال التفاصيل -->
            {{ __('lang.enter details')}}
          </span>
          <form class="login-form-2" method="post" action="{{route('register')}}">
            @csrf
            <label class="form-label">
             <!-- الإسم الأول -->
             {{ __('lang.username')}}
            </label>
            <input type="text" class="form-input" name="name" placeholder=" روبرت"  value="{{old('name')}}" >

          <label class="form-label">
            <!-- عنوان البريد الإلكتروني -->
            {{ __('lang.email')}}
          </label>
          <input type="email" class="form-input" placeholder=" robertfox@example.com" name="email" value="{{old('email')}}" >

          <label class="form-label">
           <!-- كلمة المرور -->
           {{ __('lang.password')}}
          </label>
          <input type="password"  name="password" class="form-input" placeholder="  ........... " >

          <label class="form-label">
           <!-- كلمة المرور -->
           {{ __('lang.confirm_password')}}
          </label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="  ........... " >

          {{-- <div class="forget-password-div">
            <label class="checkbox-div">
              <input type="checkbox">
              <span class="checkmark"></span>
             <!-- أوافق على الشروط والأحكام -->
             {{ __('lang.accept_all_rule')}}
            </label>

          </div> --}}
          <button type="submit" class="reserve-link ">
            <!-- التسجيل -->
            {{ __('lang.register')}}
          </button>
          </form>






      </div>
      <div class="login-img">
        <img class="img-responsive" src="{{asset('site/images/register.png')}}" alt="register image">
      </div>
    </div>


@endsection
