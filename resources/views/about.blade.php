@extends('layouts.app')
@section('title', 'About')
@section('content')
    <section class="flex justify-center items-center">
        <div class="w-full">
            <div class="flex justify-center items-end bg-blue-900 bg-cover bg-center w-full min-h-[30vh] max-h-[40vh]"
                style="background-image: url('images/sectionimage.jpeg');">



                <!-- User Welcome Section -->

                <div
                    class="flex flex-col justify-between items-center bg-opacity-90 bg-cover bg-center px-1 py-3 rounded w-[100%] text-white capitalize">


                    <div class="flex justify-between items-center bg-opacity-90 bg-cover bg-center my-2 px-4 py-3 rounded w-[100%] text-white capitalize"
                        style="background: linear-gradient(90deg, #3a96ecad 0%, #3a96ecad 100%), url('images/blue-texture.jpg');">
                        <div>

                            <p class="font-bold">About HYPEWHIP</p>
                        </div>

                    </div>


                </div>
            </div>

            <div class="mx-3 mt-[1.5rem]">

                <p class="mt-1 text-1xl poppins-light">
                    HypeWhip is a leading platform in the automotive review industry, dedicated to rewarding users for completing online surveys. We are committed to fostering innovation, enhancing digital engagement, and promoting operational efficiency within the car review landscape. Our integrated platform caters to the unique needs of car enthusiasts, dealerships, and automotive service providers, ensuring a seamless and personalized experience for users looking to share and discover car reviews worldwide.
                </p>
            </div>

            <div class="mx-3 mt-[1.5rem] text-right">
                <h2 class="border-gray-500 border-b text-base uppercase poppins-bold">Who

                    <span class="font-bold text-indigo-600">We Are</span>


                </h2>
                <p class="mt-2 text-1xl poppins-light">
                    HypeWhip has been empowering the automotive review industry for years with innovative solutions designed to streamline operations, maximize rewards, and enhance user experiences. With a comprehensive range of products and services, we provide solutions that help businesses in the car sector thrive in a competitive and rapidly evolving market.
                    <img class="py-5" src="{{asset('images/team.png')}}" alt="Random Business or Travel Image">
                    Whether you are a car dealership aiming to increase customer engagement, a reviewer seeking to enhance your feedback experience, or an automotive service provider looking for efficient ways to connect with users, HypeWhip offers the tools and expertise you need to succeed.
                </p>
            </div>

            <div class="mx-3 mt-[1.5rem]">
                <h2 class="border-gray-500 border-b text-base uppercase poppins-bold">What We Are

                    <span class="font-bold text-indigo-600">Striving to achieve</span>


                </h2>
                <p class="mt-2 text-1xl poppins-light">
                    Our mission at HypeWhip is to drive growth and evolution in the automotive review industry by providing the most innovative, comprehensive, and efficient technology solutions. We aim to empower businesses to stay ahead of the competition by offering tools that integrate cutting-edge data intelligence, cloud technology, AI, and automation.
                    <img class="mt-3" src="{{asset('images/ease.png')}}" alt="">
                </p>
            </div>

             <!-- Feature Highlight Section -->
             <div class="flex flex-col gap-2 mx-3 mt-[1.5rem] capitalize">

                <div class="mt-2 text-right">
                    <h2 class="border-gray-500 border-b text-base uppercase poppins-bold">Empower Your Car Review Experience with

                        <span class="font-bold text-indigo-600 uppercase">Our Comprehensive Web Application</span>
                        <img src="{{asset('images/review2.jpg')}}" alt="Random Business or Travel Image">

                    </h2>
                    <p class="mt-1 text-1xl poppins-light">A complete web-based application designed for car reviewers that enables users
                        to easily discover, evaluate, and manage vehicle reviews on behalf of their audience.</p>
                </div>
            </div>

            <div class="flex flex-col gap-2 mx-3 mt-[1.5rem] capitalize">
                <div class="self-start h-auto">
                    <img src="{{asset('images/review.jpg')}}" alt="Random Business or Travel Image">
                </div>
                <div class="self-start mt-2 max-w-[90%] text-left">
                    <h2 class="border-gray-500 border-b text-base uppercase poppins-bold">Streamline Your Workflow with

                        <span class="font-bold text-indigo-600 uppercase">with HypeWhip Bot</span>

                    </h2>
                    <p class="mt-1 text-1xl poppins-light">With HypeWhip Bot, effortlessly manage tasks, track performance, and optimize your workflow. Our bot is specifically designed to enhance your operations and boost productivity.
                    </p>
                </div>
            </div>

            <div class="flex flex-col gap-2 mx-3 mt-[1.5rem] capitalize">
                <div class="self-end h-auto">
                    <img src="{{asset('images/bot.jpg')}}" alt="Random Business or Travel Image">
                </div>
                <div class="self-start mt-2 text-right">
                    <h2 class="border-gray-500 border-b text-base uppercase poppins-bold">Maximize Your Efficiency with

                        <span class="font-bold text-indigo-600 uppercase">Our Review Management Bot</span>

                    </h2>
                    <p class="mt-1 text-1xl poppins-light">
                        Make the most of your time with our bot, crafted to help you manage tasks, track performance, and optimize your workflow. Effortlessly enhance your productivity and streamline your operations.


                    </p>
                </div>
            </div>

            <br>
            <br>
            <br>
            <br>
        </div>
    </section>
@endsection
