<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/a21ee8a7f1.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="https://placehold.co/300x300/000000/FFF?text=hw" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    {{-- canaconical --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- <link rel="canonical" href="http://hypewhip.loca.lt/"> --}}

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <title>{{ config('app.name', 'Laravel') }} | @yield('title') </title>

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        #qrcode {
            width: 200px; /* Set your desired width */
            height: 200px; /* Set your desired height */
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            margin: auto;
        }

        #qrcode img {
            width: 100%; /* Make the QR code image responsive */
            height: auto; /* Maintain aspect ratio */
            margin: auto;
        }
    </style>
</head>

<body class="relative bg-black mx-auto max-w-[425px] font-sans text-gray-900 antialiased" x-data="{ sidenav: false }">


   <div id="preloader" class="hole">
           <i></i>
           <i></i>
           <i></i>
           <i></i>
           <i></i>
           <i></i>
           <i></i>
           <i></i>
           <i></i>
           <i></i>
           <p class="animated-text oleo-script-regular">
               HypeWhip...
           </p>
       </div>
       <div
           class="hidden right-0 bottom-3 z-[600] fixed space-y-6 mx-auto mt-4 w-3/4 flash-message tray-success animate__animated">

           @if (session()->has('success'))
               <div class="flex items-center bg-white shadow-[0_3px_10px_-3px_rgba(6,81,237,0.3)] p-4 rounded-md text-slate-900"
                   role="alert">
                   <svg xmlns="http://www.w3.org/2000/svg" class="inline fill-green-600 mr-3 w-[18px] shrink-0"
                       viewBox="0 0 512 512">
                       <ellipse cx="246" cy="246" data-original="#000" rx="246" ry="246" />
                       <path class="fill-white"
                           d="m235.472 392.08-121.04-94.296 34.416-44.168 74.328 57.904 122.672-177.016 46.032 31.888z"
                           data-original="#000" />
                   </svg>
                   <span class="font-semibold text-[15px] tracking-wide">{{ session('success') }}</span>
               </div>
           @elseif (session()->has('regsuccess') && session()->has('name'))
               <div class="flex items-center bg-white shadow-[0_3px_10px_-3px_rgba(6,81,237,0.3)] p-4 rounded-md text-slate-900"
                   role="alert">
                   <svg xmlns="http://www.w3.org/2000/svg" class="inline fill-green-600 mr-3 w-[18px] shrink-0"
                       viewBox="0 0 512 512">
                       <ellipse cx="246" cy="246" data-original="#000" rx="246" ry="246" />
                       <path class="fill-white"
                           d="m235.472 392.08-121.04-94.296 34.416-44.168 74.328 57.904 122.672-177.016 46.032 31.888z"
                           data-original="#000" />
                   </svg>
                   <span class="font-semibold text-[15px] tracking-wide">
                       {{ session('regsuccess') }}
                       {{ session('name') }}
                   </span>
               </div>
           @elseif (session()->has('info'))
               <div class="flex items-center bg-white shadow-[0_3px_10px_-3px_rgba(6,81,237,0.3)] p-4 rounded-md text-slate-900"
                   role="alert">
                   <svg xmlns="http://www.w3.org/2000/svg" class="inline fill-blue-600 mr-3 w-[18px] shrink-0"
                       viewBox="0 0 23.625 23.625">
                       <path
                           d="M11.812 0C5.289 0 0 5.289 0 11.812s5.289 11.813 11.812 11.813 11.813-5.29 11.813-11.813S18.335 0 11.812 0zm2.459 18.307c-.608.24-1.092.422-1.455.548a3.838 3.838 0 0 1-1.262.189c-.736 0-1.309-.18-1.717-.539s-.611-.814-.611-1.367c0-.215.015-.435.045-.659a8.23 8.23 0 0 1 .147-.759l.761-2.688c.067-.258.125-.503.171-.731.046-.23.068-.441.068-.633 0-.342-.071-.582-.212-.717-.143-.135-.412-.201-.813-.201-.196 0-.398.029-.605.09-.205.063-.383.12-.529.176l.201-.828c.498-.203.975-.377 1.43-.521a4.225 4.225 0 0 1 1.29-.218c.731 0 1.295.178 1.692.53.395.353.594.812.594 1.376 0 .117-.014.323-.041.617a4.129 4.129 0 0 1-.152.811l-.757 2.68a7.582 7.582 0 0 0-.167.736 3.892 3.892 0 0 0-.073.626c0 .356.079.599.239.728.158.129.435.194.827.194.185 0 .392-.033.626-.097.232-.064.4-.121.506-.17l-.203.827zm-.134-10.878a1.807 1.807 0 0 1-1.275.492c-.496 0-.924-.164-1.28-.492a1.57 1.57 0 0 1-.533-1.193c0-.465.18-.865.533-1.196a1.812 1.812 0 0 1 1.28-.497c.497 0 .923.165 1.275.497.353.331.53.731.53 1.196 0 .467-.177.865-.53 1.193z"
                           data-original="#030104" />
                   </svg>
                   <span class="font-semibold text-[15px] tracking-wide">{{ session('info') }}</span>
               </div>
           @elseif (session()->has('error'))
               <div class="flex items-center bg-white shadow-[0_3px_10px_-3px_rgba(6,81,237,0.3)] p-4 rounded-md text-slate-900"
                   role="alert">
                   <svg xmlns="http://www.w3.org/2000/svg" class="inline fill-yellow-600 mr-3 w-[18px] shrink-0"
                       viewBox="0 0 128 128">
                       <path
                           d="M56.463 14.337 6.9 106.644C4.1 111.861 8.173 118 14.437 118h99.126c6.264 0 10.338-6.139 7.537-11.356L71.537 14.337c-3.106-5.783-11.968-5.783-15.074 0z" />
                       <g class="fill-white">
                           <path
                               d="M64 31.726a5.418 5.418 0 0 0-5.5 5.45l1.017 44.289A4.422 4.422 0 0 0 64 85.726a4.422 4.422 0 0 0 4.482-4.261L69.5 37.176a5.418 5.418 0 0 0-5.5-5.45z"
                               data-original="#fff" />
                           <circle cx="64" cy="100.222" r="6" data-original="#fff" />
                       </g>
                   </svg>
                   <span class="font-semibold text-[15px] tracking-wide">{{ session('error') }}</span>
               </div>
           @endif

           @if ($errors->any())
               <div class="flex items-center bg-white shadow-[0_3px_10px_-3px_rgba(6,81,237,0.3)] p-4 rounded-md text-slate-900"
                   role="alert">
                   <svg xmlns="http://www.w3.org/2000/svg" class="inline fill-red-600 mr-3 w-[18px] shrink-0"
                       viewBox="0 0 32 32">
                       <path
                           d="M16 1a15 15 0 1 0 15 15A15 15 0 0 0 16 1zm6.36 20L21 22.36l-5-4.95-4.95 4.95L9.64 21l4.95-5-4.95-4.95 1.41-1.41L16 14.59l5-4.95 1.41 1.41-5 4.95z"
                           data-original="#ea2d3f" />
                   </svg>
                   <span class="font-semibold text-[15px] tracking-wide">

                       @foreach ($errors->all() as $error)
                           <span class="block">{{ $error }} </span>
                       @endforeach
                   </span>
               </div>
           @enderror









       </div>
       <script>
           function showFlashMessage() {
               const flashMessage = document.querySelector('.flash-message');
               flashMessage.style.display = 'block'; // Show the message
               flashMessage.classList.add('animate__fadeInRight'); // Add animation class

               // Optionally, hide the message after a few seconds
               setTimeout(() => {
                   // flashMessage.classList.remove('animate__backInRight'); // Add animation
                   flashMessage.classList.add('animate__fadeOutRight'); // Add animation
                   flashMessage.style.display = 'none'; // Hide the message after 3 seconds
               }, 5000);
           }

           window.onload = function() {
               const preloader = document.getElementById('preloader');
               preloader.style.opacity = '0'; // Start fading out
               setTimeout(() => {
                   preloader.style.display = 'none'; // Hide after fade out
               }, 1000); // Duration should match the CSS transition

               showFlashMessage()
           };
       </script>

    <header id="header"
        class="top-0 left-1/2 z-[998] fixed flex justify-between items-center mx-auto px-2 py-4 border-gray-300 border-t w-full max-w-[425px] -translate-x-1/2 transform">
        <h1 class="flex items-center gap-2 text-white text-2xl">

            <img class="rounded-full w-[40px]" src="{{$profilePic}}" alt="">
            <a class="text-2xl capitalize poppins-bold" href="#">Hypewhip</a>
        </h1>

        <div class="flex gap-4">
            <a href="{{route('notification')}}" class="flex justify-center items-center p-2 border border-white rounded-full">
                <img src="{{ asset('./images/notification.svg') }}" alt="notification" class="inline-block w-6">
            </a>
            <a href="javascript:void(0)" @click="sidenav = !sidenav" class="flex justify-center items-center rounded-md">
                <img src="{{ asset('./images/menu.svg') }}" alt="notification" class="inline-block w-6">
            </a>
        </div>
    </header>

    <div x-show="sidenav" @click.outside="sidenav = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-x-full"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform -translate-x-full"
        class="top-0 z-[998] fixed flex flex-col items-start gap-y-2 bg-slate-100 mx-auto px-2 py-3 border-gray-300 border-t w-[95%] max-w-[325px] h-[100vh] overflow-y-auto">
        {{-- <div class="flex gap-2">
                    <span class="mdi mdi-close"></span>
                    <span>Close</span>
                </div> --}}

        <div class="flex items-center gap-3 py-2 border-gray-400 border-b w-full">
            <div class="flex justify-center items-center rounded-full h-[50px]">
                <img class="rounded-full w-[50px]" src="{{ $profilePic}}" alt="">
            </div>
            <div class="flex justify-between items-center w-full">
                <p class="text-base tracking-wide poppins-medium">Hello {{$user->name}}!</p>
                <span @click="sidenav = !sidenav" class="text-red-700 mdi mdi-close"></span>
            </div>
        </div>

        <div class="flex justify-between items-center gap-3">
            <div class="flex justify-center items-center bg-blue-600 p-2 rounded-full w-[35px] h-[35px] text-white">
                <span class="px-1 border border-white rounded-full mdi mdi-currency-usd"></span>
            </div>
            <div>
                <span class="text-[70%] poppins-light">Total Earnings</span>
                <p class="text-base poppins-medium">${{  $user->questJob ?   $user->questJob->earnings ?? '0.00' : '0.00'}}</p>
            </div>
        </div>

        <div class="flex justify-between items-center gap-3">
            <div class="flex justify-center items-center bg-blue-600 p-2 rounded-full w-[35px] h-[35px] text-white">
                <span class="px-1 border border-white rounded-full mdi mdi-wallet-bifold"></span>
            </div>
            <div>
                <span class="text-[70%] poppins-light">Balance</span>
                <p class="text-base poppins-medium">{{ $user->userWallet ? ( '$' . $user->userWallet->wallet_balance ?? 'No wallet :)') : 'No wallet :)' }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3 pb-2 border-gray-400 border-b w-full">
            <div class="flex justify-center items-center bg-blue-600 p-2 rounded-full w-[35px] h-[35px] text-white">
                <span class="px-1 border border-white rounded-full mdi mdi-account-multiple"></span>
            </div>
            <div>
                <span class="text-[70%] poppins-light">Referral Code</span>
                <div class="text-sm copyButton poppins-light" data-text-id="referralCode1">
                    <span id="referralCode1" class="textToCopy">{{ $user->referral_code }}</span>
                    <span class="mdi-content-copy mdi"></span>
                </div>
            </div>
        </div>
        <a href="{{route('about')}}" class="flex items-center gap-3 pb-2 border-gray-400 border-b w-full">
            <div class="flex justify-center items-center bg-blue-600 p-2 rounded-full w-[35px] h-[35px] text-white">
                <span class="px-1 border border-white rounded-full mdi-information-outline mdi"></span>
            </div>
            <div>
                <span class="text-[70%] poppins-light">About</span>
            </div>
        </a>
        <a href="{{route('terms')}}" class="flex items-center gap-3 pb-2 border-gray-400 border-b w-full">
            <div class="flex justify-center items-center bg-blue-600 p-2 rounded-full w-[35px] h-[35px] text-white">
                <span class="px-1 border border-white rounded-full mdi mdi-vpn"></span>
            </div>
            <div>
                <span class="text-[70%] poppins-light">Terms and Condition</span>
            </div>
        </a>
        {{-- <a href="/faq" class="flex items-center gap-3 pb-2 border-gray-400 border-b w-full">
            <div class="flex justify-center items-center bg-blue-600 p-2 rounded-full w-[35px] h-[35px] text-white">
                <span class="px-1 border border-white rounded-full mdi mdi-frequently-asked-questions"></span>
            </div>
            <div>
                <span class="text-[70%] poppins-light">FAQS</span>
            </div>
        </a> --}}
        <a href="{{route('wallet.topup')}}" class="flex items-center gap-3 pb-2 border-gray-400 border-b w-full">
            <div class="flex justify-center items-center bg-blue-600 p-2 rounded-full w-[35px] h-[35px] text-white">
                <span class="px-1 border border-white rounded-full mdi mdi-cash-fast"></span>
            </div>
            <div>
                <span class="text-[70%] poppins-light">Top Up</span>
            </div>
        </a>
        <a href="/withdraw" class="flex items-center gap-3 pb-2 border-gray-400 border-b w-full">
            <div class="flex justify-center items-center bg-blue-600 p-2 rounded-full w-[35px] h-[35px] text-white">
                <span class="px-1 border border-white rounded-full mdi mdi-wallet"></span>
            </div>
            <div>
                <span class="text-[70%] poppins-light">Withdraw</span>
            </div>
        </a>
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="flex items-center gap-3 bg-transparent pb-2 border-gray-400 border-b w-full text-left">
                <div class="flex justify-center items-center bg-blue-600 p-2 rounded-full w-[35px] h-[35px] text-white">
                    <span class="px-1 border border-white rounded-full mdi mdi-logout"></span>
                </div>
                <div>
                    <span class="text-[70%] poppins-light">Logout</span>
                </div>
            </button>
        </form>

    </div>

    <main class="relative bg-white mx-auto">
        {{-- Mobile Header --}}


        <section>
            @yield('content')
        </section>


    </main>

    <!-- From Uiverse.io by Cybercom682 -->
    <div style="display: none !important;" class="space-y-2 p-4">
        <div role="alert"
            class="flex items-center bg-green-100 hover:bg-green-200 dark:bg-green-900 dark:hover:bg-green-800 p-2 border-green-500 dark:border-green-700 border-l-4 rounded-lg text-green-900 dark:text-green-100 hover:scale-105 transition duration-300 ease-in-out transform">
            <svg stroke="currentColor" viewBox="0 0 24 24" fill="none"
                class="flex-shrink-0 mr-2 w-5 h-5 text-green-600" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"
                    stroke-linejoin="round" stroke-linecap="round"></path>
            </svg>
            <p class="font-semibold text-xs">Success - Everything went smoothly!</p>
        </div>

        <div role="alert"
            class="flex items-center bg-blue-100 hover:bg-blue-200 dark:bg-blue-900 dark:hover:bg-blue-800 p-2 border-blue-500 dark:border-blue-700 border-l-4 rounded-lg text-blue-900 dark:text-blue-100 hover:scale-105 transition duration-300 ease-in-out transform">
            <svg stroke="currentColor" viewBox="0 0 24 24" fill="none"
                class="flex-shrink-0 mr-2 w-5 h-5 text-blue-600" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"
                    stroke-linejoin="round" stroke-linecap="round"></path>
            </svg>
            <p class="font-semibold text-xs">
                Info - This is some information for you.
            </p>
        </div>

        <div role="alert"
            class="flex items-center bg-yellow-100 hover:bg-yellow-200 dark:bg-yellow-900 dark:hover:bg-yellow-800 p-2 border-yellow-500 dark:border-yellow-700 border-l-4 rounded-lg text-yellow-900 dark:text-yellow-100 hover:scale-105 transition duration-300 ease-in-out transform">
            <svg stroke="currentColor" viewBox="0 0 24 24" fill="none"
                class="flex-shrink-0 mr-2 w-5 h-5 text-yellow-600" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"
                    stroke-linejoin="round" stroke-linecap="round"></path>
            </svg>
            <p class="font-semibold text-xs">
                Warning - Be careful with this next step.
            </p>
        </div>

        <div role="alert"
            class="flex items-center bg-red-100 hover:bg-red-200 dark:bg-red-900 dark:hover:bg-red-800 p-2 border-red-500 dark:border-red-700 border-l-4 rounded-lg text-red-900 dark:text-red-100 hover:scale-105 transition duration-300 ease-in-out transform">
            <svg stroke="currentColor" viewBox="0 0 24 24" fill="none"
                class="flex-shrink-0 mr-2 w-5 h-5 text-red-600" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"
                    stroke-linejoin="round" stroke-linecap="round"></path>
            </svg>
            <p class="font-semibold text-xs">Error - Something went wrong.</p>
        </div>
    </div>

    <footer
        class="bottom-0 left-1/2 fixed bg-slate-100 mx-auto py-2 border-gray-300 border-t w-full max-w-[425px] -translate-x-1/2 transform">

        <div class="flex justify-between gap-5 px-2">
            <a href="/"
                class="flex flex-col justify-center items-center gap-1 py-1 text-gray-500 hover:text-gray-800 text-sm text-center">
                <span
                    class="  {{ Request::routeIs('dashboard') ? 'text-indigo-900' : '' }} mdi mdi-home text-[25px]"></span>
                <p class="text-[80%] poppins-light">Dashboard</p>
            </a>
            <a href="{{ route('wallet') }}"
                class="flex flex-col justify-center items-center gap-1 py-1 text-gray-500 hover:text-gray-800 text-sm text-center">
                <span
                    class="{{ Request::is('wallet') || Request::is('wallet*') ? 'text-indigo-900' : '' }} mdi mdi-wallet text-[25px]"></span>
                <p class="text-[80%] poppins-light">Wallet</p>
            </a>
            <a href="javascript:void"
                class="flex flex-col justify-center items-center gap-1 py-1 text-gray-500 hover:text-gray-800 text-sm text-center">
                <span class="text-[25px] mdi mdi-wallet"></span>
                <p class="text-[80%] poppins-light">Wallet</p>
            </a>

            <!-- Your other content here -->

            <div
                class="top-0 left-1/2 absolute flex flex-col justify-center items-center gap-1 bg-slate-100 shadow shadow-gray-400 mb-5 border-gray-300 border-b rounded-full w-[65px] h-[65px] text-gray-500 hover:text-gray-900 text-sm text-center scale-[1.25] hover:scale-[1.3] -translate-x-1/2 -translate-y-3 transform">
                <a href="{{ route('tasks') }}">
                    <span
                        class="{{ Request::is('tasks') || Request::is('tasks*') ? 'text-indigo-900' : '' }} mdi mdi-car-multiple text-[25px]"></span>
                    <p class="text-[80%] poppins-light">Tasks</p>
                </a>
            </div>

            <a href="{{ route('withdraw') }}"
                class="flex flex-col justify-center items-center gap-1 py-1 text-gray-500 hover:text-gray-800 text-sm text-center">
                <span
                    class="{{ Request::is('withdraw') || Request::is('withdraw*') ? 'text-indigo-900' : '' }} mdi mdi-cash-fast text-[25px]"></span>
                <p class="text-[80%] poppins-light">Withdraw</p>
            </a>
            <a href="{{ route('profile') }}"
                class="flex flex-col justify-center items-center gap-1 py-1 text-gray-500 hover:text-gray-800 text-sm text-center">
                <span
                    class="{{ Request::is('profile') || Request::is('profile*') ? 'text-indigo-900' : '' }} mdi mdi-account text-[25px]"></span>
                <p class="text-[80%] poppins-light">Profile</p>
            </a>
        </div>
    </footer>





    <script>
       document.querySelectorAll('.copyButton').forEach((button) => {
    button.addEventListener('click', function() {
        const textId = this.getAttribute('data-text-id'); // Get the ID from the data attribute
        const text = document.getElementById(textId).innerText; // Get the text to copy
        navigator.clipboard.writeText(text).then(() => {
            alert('Text copied to clipboard!');
        }).catch(err => {
            console.error('Error copying text: ', err);
        });
    });
});
    </script>

    <script>
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const passwordVisible = passwordInput.nextElementSibling.querySelector('.password-visible');
            const passwordHidden = passwordInput.nextElementSibling.querySelector('.password-hidden');

            // Toggle password visibility
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text'; // Show the password
                passwordVisible.classList.remove('hidden'); // Show the open eye icon
                passwordHidden.classList.add('hidden'); // Hide the closed eye icon
            } else {
                passwordInput.type = 'password'; // Hide the password
                passwordVisible.classList.add('hidden'); // Hide the open eye icon
                passwordHidden.classList.remove('hidden'); // Show the closed eye icon
            }
        }
    </script>

    <script>
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 0) {
                header.classList.add('blur-bg');
            } else {
                header.classList.remove('blur-bg');
            }
        });
    </script>
</body>

</html>
