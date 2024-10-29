@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="screen">
        <div class="screen__content">

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="login">
                @csrf

                <h3 class="text-center">LOGIN</h3>
                <!-- Email Address Field -->
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input 
                        type="text" 
                        class="login__input" 
                        name="email" 
                        placeholder="User name / Email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        autocomplete="username"
                    >
                    @error('email')
                        <span class="text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input 
                        type="password" 
                        class="login__input" 
                        name="password" 
                        placeholder="Password" 
                        required 
                        autocomplete="current-password"
                    >
                    @error('password')
                        <span class="text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me Checkbox -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" 
                            name="remember"
                        >
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button class="button login__submit">
                    <span class="button__text">Log In Now</span>
                    <i class="button__icon fas fa-chevron-right"></i>
                </button>
                <br>
                <!-- Forgot Password Link -->
                @if (Route::has('register'))
                    <a class="underline text-sm text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-red-800" href="{{ route('register') }}">
                        {{ __('If Don`t have any account!') }}
                    </a>
                @endif
            </form>
        </div>

        <!-- Background Shapes -->
        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape4"></span>
            <span class="screen__background__shape screen__background__shape3"></span>
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>
    </div>
</div>
@endsection
