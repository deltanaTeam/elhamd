@extends('auth.guest') 
@section('content')

<div class="container py-4">
    <div class="text-light mb-4">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('pharmacist.password.confirm') }}" class="p-4 rounded">
        @csrf

        <div class="form-group">
            <label for="password" class="text-light">{{ __('Password') }}</label>
            <input id="password"
                   type="password"
                   name="password"
                   class="form-control bg-dark text-white border-secondary"
                   required
                   autocomplete="current-password">
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group text-right mt-4">
            <button type="submit" class="btn btn-login">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</div>

@endsection
