@extends('layouts.guest')
@section('title', 'Create an account to enjoy a rewarding experience')
@section('content')

    <section class="h-[100%] w-[90%] py-10 md:w-[50%] md:py-20">
        <div>
            <div class="mb-7 text-center text-slate-200">
                <h1 class="oleo-script-bold mb-6 text-3xl font-[700]">Hype Whip</h1>
                <h2 class="poppins-regular mb-3 text-base font-[500]">Create an Account</h2>
                <p class="poppins-light text-sm">We require new users create an account to experience our platform... </p>
            </div>
            <form class="w-full" method="POST" action="/register">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- Name -->
                <div>
                    <label for="referal" class="block text-sm font-light text-gray-500">Referal Code</label>
                    <input id="referal_token" name="referral_token"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="text" name="referal" value="{{old('referral_token')}}" maxlength="6" required autofocus autocomplete="referal" />
                    <div class="mt-2 text-sm text-red-600">

                        @error('referral_token')
                            {{$message}}
                        @enderror
                    </div>
                </div>


                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-light text-gray-500">Name</label>
                    <input id="name"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{old('name')}}"
                        type="text" name="name"   required autofocus autocomplete="name" />
                    <div class="mt-2 text-sm text-red-600">
                        @error('name')
                            {{$message}}
                        @enderror
                    </div>
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email" class="block text-sm font-light text-gray-500">Email</label>
                    <input id="email"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="email" name="email" value="{{old('email')}}" required autocomplete="email" />
                    <div class="mt-2 text-sm text-red-600">
                                            @error('email')
                                                {{$message}}
                                            @enderror
                                        </div>
                </div>
                <div class="mt-4">
                    <label for="email" class="block text-sm font-light text-gray-500">Contact No</label>
                    <input id="email"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        type="tel" name="contact_no" required autocomplete="tel" value="{{old('contact_no')}}" />
                  <div class="mt-2 text-sm text-red-600">
                                          @error('contact_no')
                                              {{$message}}
                                          @enderror
                                      </div>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block text-sm font-light text-gray-500">Password</label>
                    <div class="relative">
                        <input id="password"
                            class="password-input mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            type="password" name="password" required autocomplete="new-password" />
                        <div class="absolute right-[5px] top-0 mt-3 cursor-pointer"
                            onclick="togglePasswordVisibility('password')">
                            <img class="password-visible hidden h-[20px]" src="{{ asset('./images/eye-open.svg') }}"
                                alt="Show Password">
                            <img class="password-hidden h-[20px]" src="{{ asset('./images/eye-closed.svg') }}"
                                alt="Hide Password">
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-red-600">
                                            @error('password')
                                                {{$message}}
                                            @enderror
                                        </div>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" class="block text-sm font-light text-gray-500">Confirm
                        Password</label>
                    <div class="relative">
                        <input id="password_confirmation"
                            class="password-input mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            type="password" name="password_confirmation" required autocomplete="new-password" />
                        <div class="absolute right-[5px] top-0 mt-3 cursor-pointer"
                            onclick="togglePasswordVisibility('password_confirmation')">
                            <img class="password-visible hidden h-[20px]" src="{{ asset('./images/eye-open.svg') }}"
                                alt="Show Password">
                            <img class="password-hidden h-[20px]" src="{{ asset('./images/eye-closed.svg') }}"
                                alt="Hide Password">
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-red-600">
                                            @error('password_confirmation')
                                                {{$message}}
                                            @enderror
                                        </div>
                </div>

                <!-- Wallet Pin -->
                <div class="mt-4">
                    <label for="wallet_pin" class="block text-sm font-light text-gray-500">Wallet Pin</label>
                    <div class="relative">
                        <input id="wallet_pin"
                            class="password-input mt-1 block w-full rounded-md border-gray-300 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            type="password" name="wallet_pin" required autocomplete="new-password" />
                        <div class="absolute right-[5px] top-0 mt-3 cursor-pointer"
                            onclick="togglePasswordVisibility('wallet_pin')">
                            <img class="password-visible hidden h-[20px]" src="{{ asset('./images/eye-open.svg') }}"
                                alt="Show Password">
                            <img class="password-hidden h-[20px]" src="{{ asset('./images/eye-closed.svg') }}"
                                alt="Hide Password">
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-red-600">
                                            @error('password')
                                                {{$message}}
                                            @enderror
                                        </div>
                </div>





                <div class="mt-4">
                    {!! htmlFormSnippet() !!}
                    @if ($errors->has('g-recaptcha-response'))
                        <div>
                            <small class="text-red-500">
                                {{ $errors->first('g-recaptcha-response') }}
                            </small>
                        </div>
                    @endif
                </div>
                <div class="mt-4 flex items-center justify-end">
                    <a class="rounded-md text-sm font-light text-gray-400 underline hover:text-gray-100"
                        href="/login">
                        Already registered?
                    </a>

                    <button type="submit" class="ms-4 rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                        Register
                    </button>
                </div>
            </form>

        </div>
    </section>

@endsection
