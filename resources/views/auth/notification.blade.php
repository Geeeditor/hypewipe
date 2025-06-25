@extends('layouts.app')
@section('title', 'Notification Center')
@section('content')
    <section class="flex justify-center items-center">
        <div class="w-[100%]">
            <!-- Header Section with Background Image -->
            <div class="flex justify-center items-end bg-blue-900 bg-cover bg-center min-h-[50vh] max-h-[60vh]"
                style="background-image: url('images/wallet-bg.jpg');">

                <!-- User Welcome Section -->
                <div
                    class="flex flex-col justify-between items-center bg-opacity-90 bg-cover bg-center px-4 py-3 rounded w-full text-white capitalize">

                    <div class="flex justify-between items-center bg-opacity-90 bg-cover bg-center my-2 px-4 py-3 rounded w-full text-white capitalize"
                        style="background: linear-gradient(90deg, #3a96ecad 0%, #3a96ecad 100%), url('images/blue-texture.jpg');">





                        <div x-data="{tooltip: false}" class="relative my-2 w-2/3" >
                            <h3 class="flex items-center gap-2 w-[100px] text-sm">
                                <span class="text-base poppins-medium">Notification</span>
                                <span @click="tooltip = !tooltip" class="mdi-information-box-outline mdi"></span>

                            </h3>
                            <div x-transition x-show="tooltip" @click.outside="tooltip = false" class="hover:block top-6 left-0 z-10 absolute bg-white shadow-lg p-2 rounded-md w-[200px] text-black">
                                    <p class="text-xs poppins-light">- Notifications and update will be displayed if available</p>

                                </div>

                        </div>


                        <div class="flex flex-col justify-center items-end gap-1 rounded-full w-1/3">
                            <img class="h-[50px]" src="{{asset('./images/notification-colored.svg')}}" alt="">


                        </div>

                    </div>

                    <div
                    class="flex justify-between bg-slate-100 shadow-gray-700 shadow-sm my-2 px-1 py-3 border border-gray-300 rounded-md w-full text-gray-900">
                    <div class="flex flex-col justify-start items-start">
                        <span class="text-[70%] poppins-light">Wallet</span>
                        <span class="text-sm poppins-medium">{{ $userAvailableWallets->count() }}</span>
                    </div>
                    <div class="flex flex-col justify-start items-start px-5 border-gray-300 border-x">
                        <span class="text-[70%] poppins-light">Withdrawals</span>
                        <span class="text-sm poppins-medium">{{ $withdrawals->count()}}</span>
                    </div>
                    <div class="flex flex-col justify-start items-start">
                        <span class="text-[70%] poppins-light">Deposits</span>
                        <span class="text-sm poppins-medium">{{ $userDeposits->count() }}</span>
                    </div>
                </div>
                </div>
            </div>





            <div class="mx-3 mt-5" >
                <h4 class="mb-4 font-bold text-lg text-center capitalize">Notifications</h4>
                <p class="flex flex-col justify-center items-center gap-2 mb-4 text-gray-800 text-base poppins-medium">

                    <span class="px-4 text-gray-500 text-2xl text-center capitalize poppins-medium">
                        You don't have any notification at the moment
                    </span>
                    <span class="text-[20px] text-gray-500 mdi mdi-fishbowl"></span>
                </p>



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
