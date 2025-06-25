@extends('layouts.guest')
@section('title' ,'Login to enjoy a rewarding experience')
@section('content')
<section class="h-[100%] w-[90%] py-10 md:h-fit md:w-[50%] md:py-20" >
    <div class="mb-7 text-center text-slate-200">
        <h1 class="oleo-script-bold mb-6 text-3xl font-[700]">Hype Whip</h1>
        <h2 class="poppins-regular mb-3 text-base font-[500]">Welcome Back</h2>
        <p class="poppins-light text-sm">Please enter the email and password associated with your registered account to continue your experience....</p>
    </div>
    <form class="w-full"  method="POST" action="/login">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-light text-gray-500">Email</label>
            <input id="email" class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="email" name="email" required autofocus autocomplete="username" />
            <div class="mt-2 text-sm text-red-600">
                <!-- Error messages for email -->
                <!-- Example: <span>Invalid email address.</span> -->
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-light text-gray-500">Password</label>


            <div class="relative">
                <input id="password" class="password-input mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password" required autocomplete="current-password" />
                <div class="absolute right-[5px] top-0 mt-3 cursor-pointer" onclick="togglePasswordVisibility('password')">
                    <img class="password-visible hidden h-[20px]" src="{{ asset('./images/eye-open.svg') }}" alt="Show Password">
                    <img class="password-hidden h-[20px]" src="{{ asset('./images/eye-closed.svg') }}" alt="Hide Password">
                </div>
            </div>


            <div class="mt-2 text-sm text-red-600">
                <!-- Error messages for password -->
                <!-- Example: <span>Incorrect password.</span> -->
            </div>
        </div>



        <!-- Remember Me -->
        <div class="mt-4 block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm font-light text-gray-500">Remember me</span>
            </label>
        </div>

        <div class="mt-4">
            {!!htmlFormSnippet()!!}
            @if ($errors->has('g-recaptcha-response'))
                <div>
                    <small class="text-red-500">
                        {{$errors->first('g-recaptcha-response')}}
                    </small>
                </div>
            @endif
        </div>

        <div class="mt-4 flex items-center justify-between">
            <div class="flex w-[70%] flex-col gap-3 md:flex-row">
                <a class="rounded-md text-sm font-light text-gray-400 underline hover:text-gray-100" href="#">
                    Forgot your password?
                </a>
                <a class="rounded-md text-sm font-light text-gray-400 underline hover:text-gray-100" href="/register">
                    New to HypeWhip?
                </a>
            </div>

            <button type="submit" class="ms-3 rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                Log in
            </button>
        </div>


    </form>
</section>
@endsection

