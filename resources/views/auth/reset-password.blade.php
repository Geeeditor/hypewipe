@extends('layouts.guest')
@section('title', 'Reset Password')
@section('content')
<section class="py-10 md:py-20 w-[90%] md:w-[50%] h-[100%] md:h-fit">
    <div class="mb-7 text-slate-200 text-center">
        <h1 class="mb-6 font-[700] text-3xl oleo-script-bold">Hype Whip</h1>
        <h2 class="mb-3 font-[500] text-base poppins-regular">Reset Your Password</h2>
        <p class="text-sm poppins-light">Please enter your email and new password.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="w-full">
        @csrf
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-light text-gray-500 text-sm">Email</label>
            <input id="email"
                   class="block shadow-sm mt-1 py-2 border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full"
                   type="email"
                   name="email"
                   value="{{ old('email', $request->email) }}"
                   required
                   autofocus
                   autocomplete="username" />
            @if ($errors->get('email'))
                <div class="mt-2 text-red-600 text-sm">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-light text-gray-500 text-sm">Password</label>
            <input id="password"
                   class="block shadow-sm mt-1 py-2 border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full"
                   type="password"
                   name="password"
                   required
                   autocomplete="new-password" />
            @if ($errors->get('password'))
                <div class="mt-2 text-red-600 text-sm">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block font-light text-gray-500 text-sm">Confirm Password</label>
            <input id="password_confirmation"
                   class="block shadow-sm mt-1 py-2 border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full"
                   type="password"
                   name="password_confirmation"
                   required
                   autocomplete="new-password" />
            @if ($errors->get('password_confirmation'))
                <div class="mt-2 text-red-600 text-sm">
                    {{ $errors->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <div class="flex justify-end items-center mt-4">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md text-white">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</section>
@endsection
