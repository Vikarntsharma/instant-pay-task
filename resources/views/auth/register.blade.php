@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="screen">
        <div class="screen__content">
            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" class="login">
                @csrf

                <h3 class="text-center">REGISTER</h3>

                <!-- Name Field -->
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input 
                        type="text" 
                        class="login__input" 
                        name="name" 
                        placeholder="Name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus 
                        autocomplete="name"
                    >
                    @error('name')
                        <span class="text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address Field -->
                <div class="login__field">
                    <i class="login__icon fas fa-envelope"></i>
                    <input 
                        type="email" 
                        class="login__input" 
                        name="email" 
                        placeholder="Email" 
                        value="{{ old('email') }}" 
                        required 
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
                        autocomplete="new-password"
                    >
                    @error('password')
                        <span class="text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input 
                        type="password" 
                        class="login__input" 
                        name="password_confirmation" 
                        placeholder="Confirm Password" 
                        required 
                        autocomplete="new-password"
                    >
                    @error('password_confirmation')
                        <span class="text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-4">
                    <!-- Submit Button -->
                    <button class="button login__submit">
                        <span class="button__text">Register</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                    <br>
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
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
