@extends('layouts.app')
@section('title', 'Complete HypeWhip Task To Earn Rewards')
@section('content')
    <section class="flex items-center justify-center">
        <div class="w-[100%]">
            <div class="flex max-h-[60vh] min-h-[50vh] items-end justify-center bg-blue-900 bg-cover bg-center"
                style="background-image: url('images/quest-bg.jpg');">



                <!-- User Welcome Section -->

                <div
                    class="flex w-[100%] flex-col items-center justify-between rounded bg-opacity-90 bg-cover bg-center px-4 py-3 capitalize text-white">


                    <div class="my-2 flex w-[100%] items-center justify-between rounded bg-opacity-90 bg-cover bg-center px-4 py-3 capitalize text-white"
                        style="background: linear-gradient(90deg, #3a96ecad 0%, #3a96ecad 100%), url('images/blue-texture.jpg');">
                        <div>
                            <p class="font-bold tracking-wider">Hi John Doe!</p>
                            <h3 class="poppins-light text-sm tracking-wide">Explore Your Daily Task For Rewards,</h3>
                        </div>
                        <div>
                            <img class="w-[50px]" src="{{ asset('./images/quest.jpg') }}" alt="">
                        </div>
                    </div>

                    <div
                        class="my-2 flex w-[100%] justify-between rounded-md border border-gray-300 bg-slate-100 px-1 py-3 text-gray-900 shadow-sm shadow-gray-700">
                        <div class="flex flex-col items-start justify-start">
                            <span class="poppins-light text-[70%]">Credit Balance</span>
                            <span class="poppins-medium text-sm">  {{ $user->userWallet ? '$' . $user->userWallet->wallet_balance ?? 'No wallet :)' : 'No wallet :)' }}</span>
                        </div>
                        <div class="flex flex-col items-start justify-start border-x border-gray-400 px-3">
                            <span class="poppins-light text-[70%]">Total Earnings</span>
                            <span class="poppins-medium text-sm">$ {{  $user->questJob ?  $taskData->earnings ?? '0.00' : '0.00'}}</span>
                        </div>
                        <div class="flex flex-col items-start justify-start border-gray-300 px-5">
                            <span class="poppins-light text-[70%]">Completed Tasks</span>
                            <span class="poppins-medium text-sm">{{  $user->questJob ?  $taskData->quest_done . '/38' ?? '0/38' : '0/38'}}  </span>
                        </div>
                    </div>
                </div>
            </div>










            <div class="mx-auto mt-8 px-2">
                <style>
                    .card {
                        width: 190px;
                        height: fit-content;
                        border-radius: 20px;
                        padding: 5px;
                        box-shadow: rgba(151, 65, 252, 0.2) 0 15px 30px -5px;
                        background-image: linear-gradient(144deg, #AF40FF, #5B42F3 50%, #00DDEB);
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                    }

                    .card__content {
                        background: rgb(5, 6, 45);
                        border-radius: 17px;
                        width: 100%;
                        height: 100%;
                        padding: 10px;
                        color: white;
                    }

                    .view-more {
                        background-color: #5B42F3;
                        color: white;
                        border: none;
                        border-radius: 10px;
                        padding: 8px 12px;
                        cursor: pointer;
                        text-align: center;
                        transition: background-color 0.3s;
                        /* margin-top: -20px; */
                    }

                    .view-more:hover {
                        background-color: #4A34C3;
                    }
                </style>


                <h2 class="poppins-medium text-center text-2xl capitalize">Your Daily Tasks</h2>

                <div class="mt-4 flex items-center justify-between">
                    <span class="mdi-arrow-left-drop-circle-outline mdi cursor-pointer text-[40px] hover:scale-[1.1] hover:text-indigo-800"></span>

                    <div id="card-items">
                        <div class="card">
                            <div class="card__content flex flex-col items-center justify-between gap-2">
                                <div class="max-h-1/3 w-full">
                                    <img class="object-contain" src="{{ asset('./images/cars/tesla.jpg') }}" alt="">
                                </div>
                                {{-- <br> --}}
                                <div class="flex h-2/3 flex-col items-center justify-center">
                                    <h3 class="text-base font-bold">Tesla X Plaid</h3>
                                    <p>Year: 2023</p>
                                    <p>Price: $30,000</p>
                                    <p>Mileage: 25 MPG</p>
                                    <code>1/38</code>
                                </div>
                                <button class="view-more">View More</button>
                            </div>
                        </div>
                    </div>

                    <span class="mdi-arrow-right-drop-circle-outline mdi cursor-pointer text-[40px] hover:scale-[1.1] hover:text-indigo-800"></span>

                </div>
            </div>



            <div class="mx-3 mb-2 mt-8">
                <h2 class="poppins-medium mb-3 mt-4 text-center text-2xl capitalize" >Find information on your favourite ride</h2>
                <div class="bg-gray-800 text-gray-100" >
                    <div class="container mx-auto max-w-4xl rounded-lg bg-gray-900 px-10 py-6 shadow-sm" >
                        <div class="flex items-center justify-between" >
                            <span class="text-sm text-gray-400" >Jun 1, 2020</span>
                            <a rel="noopener noreferrer" href="#" class="rounded bg-violet-400 px-2 py-1 font-bold text-gray-900" >Javascript</a>
                        </div>
                        <div class="mt-3" >
                            <a rel="noopener noreferrer" href="#" class="text-2xl font-bold hover:underline" >Nos creasse pendere crescit angelos etc</a>
                            <p class="mt-2" >Tamquam ita veritas res equidem. Ea in ad expertus paulatim poterunt. Imo volo aspi novi tur. Ferre hic neque vulgo hae athei spero. Tantumdem naturales excaecant notaverim etc cau perfacile occurrere. Loco visa to du huic at in dixi aër.</p>
                        </div>
                        <div class="mt-4 flex items-center justify-between" >
                            <a rel="noopener noreferrer" href="#" class="text-violet-400 hover:underline" >Read more</a>
                            <div >
                                <a rel="noopener noreferrer" href="#" class="flex items-center" >
                                    <img src="https://source.unsplash.com/50x50/?portrait" alt="avatar" class="mx-4 h-10 w-10 rounded-full bg-gray-500 object-cover" >
                                    <span class="text-gray-400 hover:underline" >Leroy Jenkins</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>




            <br>
            <br>
            <br>
            {{-- <br> --}}
             <!-- Agent Level Cards Grid -->
             <div class="gri mt-7 hidden grid-cols-2 gap-2">
                <!-- Agent Level Card (Repeated 3 times) -->
                <div class="max-w-[170px] rounded-lg border-2 bg-blue-500 py-2 text-white">
                    <h3 class="text-md text-center font-medium capitalize">trial period agent</h3>
                    <div class="mt-[15%] flex items-center justify-center">
                        <img src="https://img.icons8.com/color/96/bronze-medal.png" alt="Bronze Medal"
                            class="h-[70px] w-[40%] border-2">
                    </div>
                    <div class="mt-[1rem] flex items-center justify-center capitalize">
                        <div>
                            <span class="flex gap-2">
                                <p>recharge :</p>
                                <p class="text-lg font-bold">free</p>
                            </span>
                            <span class="flex gap-1">
                                <p class="text-xl font-bold">38</p>
                                <p class="mt-1 text-sm">orders</p>
                            </span>
                            <span class="flex gap-2">
                                <p class="text-lg font-bold">1.00%</p>
                                <p>commission</p>
                            </span>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </section>
@endsection
