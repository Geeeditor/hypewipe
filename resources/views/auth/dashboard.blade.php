@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
    <section class="flex justify-center items-center">
        <div>
            <!-- Header Section with Background Image -->
            <div class="flex justify-center items-end bg-blue-900 bg-cover bg-center min-h-[50vh] max-h-[60vh]"
                style="background-image: url('images/sectionimage.jpeg');">



                <!-- User Welcome Section -->

                <div class="flex flex-col justify-between items-center bg-opacity-90 bg-cover bg-center px-4 py-3 rounded w-[90%] text-white capitalize"
                    >


                    <div class="flex justify-between items-center bg-opacity-90 bg-cover bg-center my-2 px-4 py-3 rounded w-[100%] text-white capitalize" style="background: linear-gradient(90deg, #3a96ecad 0%, #3a96ecad 100%), url('images/blue-texture.jpg');" >
                        <div >
                            <h3 class="text-sm">Welcome,</h3>
                            <p class="font-bold">{{$user->name}}</p>
                        </div>
                        <div>
                            <img class="rounded-full h-[40px]" src="{{ $profilePic}}" alt="">
                        </div>
                    </div>

                    <div class="flex justify-between bg-slate-100 shadow-gray-700 shadow-sm my-2 px-1 py-3 border-gray-300 rounded-md w-[100%] text-gray-900 text-center">
                        <div class="flex flex-col justify-start items-start border-gray-300">
                            <span class="text-[70%] poppins-light">Credit Balance</span>
                            <span class="text-sm poppins-light">
                                {{ $user->userWallet ? ( '$' . $user->userWallet->wallet_balance ?? 'No wallet :)') : 'No wallet :)' }}
                            </span>
                        </div>
                        <div class="flex flex-col justify-start items-start px-4 border-gray-300 border-x">
                            <span class="text-[70%] poppins-light">Total Earnings</span>
                            <span class="text-sm poppins-light">${{ $user->questJob ? $user->questJob->earnings ?? '0.00' : '0.00' }}</span>
                        </div>
                        <div class="flex flex-col justify-start items-start border-gray-300">
                            <span class="text-[70%] poppins-light">Completed Tasks</span>
                            <span class="text-sm poppins-light">{{ $user->questJob ? $user->questJob->quest_done . '/38' ?? '0/38' : '0/38' }}</span>
                        </div>



                    </div>
                </div>
            </div>

            <!-- Video Section -->
            <div class="flex justify-center items-center mt-1">
                <video controls width="360">
                    <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Search Bar -->
            <div class="flex justify-center items-center gap-2 mx-auto mt-5 max-w-[90%]">
                <div class="flex justify-center items-center bg-[#010834] p-2 w-8 h-8">
                    <span class="mdi-bell-outline text-white mdi"></span>
                </div>
                <div class="floating-text-container max-w-[300px]">
                    <p class="floating-text">Welcome to HypeWhip, remember to complete your daily task to keep the earnings
                        coming....</p>
                </div>
            </div>




            <!-- Feature Highlight Section -->
            <div class="flex flex-col gap-2 mx-3 mt-[1.5rem] capitalize">
                <div class="self-start max-w-[60%] h-auto">
                    <img src="{{asset('images/review2.jpg')}}" alt="Random Business or Travel Image">
                </div>
                <div class="self-end mt-2 max-w-[80%] text-right">
                    <h2 class="border-gray-500 border-b text-base poppins-bold">Empower Your Car Review Experience with

                        <span class="font-bold text-indigo-600 capitalize">Our Comprehensive Web Application</span>

                    </h2>
                    <p class="mt-1 text-1xl poppins-light">A complete web-based application designed for car reviewers that enables users
                        to easily discover, evaluate, and manage vehicle reviews on behalf of their audience.</p>
                </div>
            </div>

            <div class="flex flex-col gap-2 mx-3 mt-[1.5rem] capitalize">
                <div class="self-start max-w-[60%] h-auto">
                    <img src="{{asset('images/review.jpg')}}" alt="Random Business or Travel Image">
                </div>
                <div class="self-start mt-2 max-w-[80%] text-left">
                    <h2 class="border-gray-500 border-b text-base poppins-bold">Streamline Your Workflow with

                        <span class="font-bold text-indigo-600 capitalize">with HypeWhip Bot</span>

                    </h2>
                    <p class="mt-1 text-1xl poppins-light">With HypeWhip Bot, effortlessly manage tasks, track performance, and optimize your workflow. Our bot is specifically designed to enhance your operations and boost productivity.
                    </p>
                </div>
            </div>

            <div class="flex flex-col gap-2 mx-3 mt-[1.5rem] capitalize">
                <div class="self-end max-w-[60%] h-auto">
                    <img src="{{asset('images/bot.jpg')}}" alt="Random Business or Travel Image">
                </div>
                <div class="self-start mt-2 max-w-[80%] text-left">
                    <h2 class="border-gray-500 border-b text-base poppins-bold">Maximize Your Efficiency with

                        <span class="font-bold text-indigo-600 capitalize">Our Review Management Bot</span>

                    </h2>
                    <p class="mt-1 text-1xl poppins-light">
                        Make the most of your time with our bot, crafted to help you manage tasks, track performance, and optimize your workflow. Effortlessly enhance your productivity and streamline your operations.


                    </p>
                </div>
            </div>

            <div class="flex flex-col gap-2 mx-3 mt-[1.5rem] capitalize">
                <div class="self-end max-w-[60%] h-auto">
                    <img class="object-fit" src="{{asset('images/supercharge.png')}}" alt="Random Business or Travel Image">
                </div>
                <div class="self-end mt-2 max-w-[80%] text-right">
                    <h2 class="border-gray-500 border-b text-base poppins-bold">Supercharge Your Car Review Experience with

                        <span class="font-bold text-indigo-600 capitalize">HypeWhip</span>

                    </h2>
                    <p class="mt-1 text-1xl poppins-light">With HypeWhip Bot

                        Manage tasks, track performance, and optimize your workflow with ease. Our bot is designed to
                        streamline your operations and enhance your productivity.
                    </p>
                </div>
            </div>

            <!-- Travel Agent Levels Section -->
            <div class="bg-black my-5 py-4 w-[100%] h-fit">
                <div class="mx-auto p-2 card">
                    <span class="card__title">Subscribe</span>
                    <p class="card__content">Get fresh car updates  delivered straight to your inbox every week.
                    </p>
                    <div class="card__form">
                        <input placeholder="Your Email" type="text">
                        <button class="sign-up"> Join Mail List</button>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            {{-- <br> --}}

            <div class="hidden mx-3 mt-[1.5em] mb-2">
                <h2 class="font-bold text-lg capitalize">online travel agent level</h2>

                <!-- Agent Level Cards Grid -->
                <div class="gap-2 grid grid-cols-2 mt-7">
                    <!-- Agent Level Card (Repeated 3 times) -->
                    <div class="bg-blue-500 py-2 border-2 rounded-lg max-w-[170px] text-white">
                        <h3 class="font-medium text-md text-center capitalize">trial period agent</h3>
                        <div class="flex justify-center items-center mt-[15%]">
                            <img src="https://img.icons8.com/color/96/bronze-medal.png" alt="Bronze Medal"
                                class="border-2 w-[40%] h-[70px]">
                        </div>
                        <div class="flex justify-center items-center mt-[1rem] capitalize">
                            <div>
                                <span class="flex gap-2">
                                    <p>recharge :</p>
                                    <p class="font-bold text-lg">free</p>
                                </span>
                                <span class="flex gap-1">
                                    <p class="font-bold text-xl">38</p>
                                    <p class="mt-1 text-sm">orders</p>
                                </span>
                                <span class="flex gap-2">
                                    <p class="font-bold text-lg">1.00%</p>
                                    <p>commission</p>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Duplicate cards removed for brevity (same structure as above) -->
                    <!-- ... -->
                </div>
            </div>
        </div>
    </section>
@endsection
