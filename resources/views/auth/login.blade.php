@extends('layouts.guest')
@section('title' ,'Login to enjoy a rewarding experience')
@section('content')
<section class="py-10 md:py-20 w-[90%] md:w-[50%] h-[100%] md:h-fit" >
    <div class="mb-7 text-slate-200 text-center">
        <h1 class="mb-6 font-[700] text-3xl oleo-script-bold">Hype Whip</h1>
        <h2 class="mb-3 font-[500] text-base poppins-regular">Welcome Back</h2>
        <p class="text-sm poppins-light">Please enter the email and password associated with your registered account to continue your experience....</p>
    </div>
    <form class="w-full"  method="POST" action="/login">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-light text-gray-500 text-sm">Email</label>
            <input id="email" class="block shadow-sm mt-1 py-2 border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <div class="mt-2 text-red-600 text-sm">
                <!-- Error messages for email -->
                <!-- Example: <span>Invalid email address.</span> -->
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-light text-gray-500 text-sm">Password</label>


            <div class="relative">
                <input id="password" class="block shadow-sm mt-1 py-2 border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full password-input" type="password" name="password" required autocomplete="current-password" />
                <div class="top-0 right-[5px] absolute mt-3 cursor-pointer" onclick="togglePasswordVisibility('password')">
                    <img class="hidden password-visible h-[20px]" src="{{ asset('./images/eye-open.svg') }}" alt="Show Password">
                    <img class="password-hidden h-[20px]" src="{{ asset('./images/eye-closed.svg') }}" alt="Hide Password">
                </div>
            </div>


            <div class="mt-2 text-red-600 text-sm">
                <!-- Error messages for password -->
                <!-- Example: <span>Incorrect password.</span> -->
            </div>
        </div>



        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="shadow-sm border-gray-300 rounded focus:ring-indigo-500 text-indigo-600" name="remember">
                <span class="ms-2 font-light text-gray-500 text-sm">Remember me</span>
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

        <div class="flex justify-between items-center mt-4">
            <div class="flex md:flex-row flex-col gap-3 w-[70%]">
                <a class="rounded-md font-light text-gray-400 hover:text-gray-100 text-sm underline" href="/forgot-password">
                    Forgot your password?
                </a>
                <a class="rounded-md font-light text-gray-400 hover:text-gray-100 text-sm underline" href="/register">
                    New to HypeWhip?
                </a>
            </div>

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 ms-3 px-4 py-2 rounded-md text-white">
                Log in
            </button>
        </div>


    </form>
</section>
@endsection

