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
                    class="flex justify-between bg-slate-100 shadow-gray-700 shadow-sm my-2 px-1 py-3 border border-gray-300 rounded-md w-[100%] text-gray-900">
                    <div class="flex flex-col justify-start items-start">
                        <span class="text-[70%] poppins-light">Credit Balance</span>
                        <span class="text-sm poppins-medium">
                            {{ $user->userWallet ? '$' . $user->userWallet->wallet_balance ?? 'No wallet :)' : 'No wallet :)' }}</span>
                    </div>
                    <div class="flex flex-col justify-start items-start px-3 border-gray-400 border-x">
                        <span class="text-[70%] poppins-light">Total Earnings</span>
                        <span class="text-sm poppins-medium">$
                            {{ $user->questJob ? $user->questJob->earnings ?? '0.00' : '0.00' }}</span>
                    </div>
                    <div class="flex flex-col justify-start items-start px-5 border-gray-300">
                        <span class="text-[70%] poppins-light">Completed Tasks</span>
                        <span
                            class="text-sm poppins-medium">{{ $user->questJob ? $user->questJob->quest_done . '/38' ?? '0/38' : '0/38' }}
                        </span>
                    </div>
                </div>
                </div>
            </div>





            <div class="mx-3 mt-5" >
                <h4 class="mb-4 font-bold text-lg text-center capitalize">Notifications</h4>

                @if ($notificationData)
                    @foreach ($notificationData as $notification )
                        <div class="flex items-center gap-3">
                            <span>
                                <svg width="34px" height="34px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 13V14.8C3 15.9201 3 16.4802 3.21799 16.908C3.40973 17.2843 3.71569 17.5903 4.09202 17.782C4.51984 18 5.0799 18 6.2 18H16.2446C16.5263 18 16.6672 18 16.8052 18.0193C16.9277 18.0365 17.0484 18.065 17.1656 18.1044C17.2977 18.1488 17.4237 18.2118 17.6757 18.3378L21 20V7.2C21 6.0799 21 5.51984 20.782 5.09202C20.5903 4.71569 20.2843 4.40973 19.908 4.21799C19.4802 4 18.9201 4 17.8 4H13M8.12132 3.87868C9.29289 5.05025 9.29289 6.94975 8.12132 8.12132C6.94975 9.29289 5.05025 9.29289 3.87868 8.12132C2.70711 6.94975 2.70711 5.05025 3.87868 3.87868C5.05025 2.70711 6.94975 2.70711 8.12132 3.87868Z" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            </span>
                            <p class="poppins-light">{{$notification}}</p>
                        </div>
                    @endforeach
                @else
                    <p class="flex flex-col justify-center items-center gap-2 mb-4 text-gray-800 text-base poppins-medium">

                        <span class="px-4 text-gray-500 text-2xl text-center capitalize poppins-medium">
                            You don't have any notification at the moment
                        </span>
                        <span class="text-[20px] text-gray-500 mdi mdi-fishbowl"></span>
                    </p>
                @endif







            </div>

            <div class="mx-auto mt-8 px-2">
                <div class="flex-col">
                    <h2 class="flex-1 text-gray-900 poppins-medium">Latest Withdrawals</h2>

                    <div class="mt-4">
                        <div class="flex justify-start items-center">
                            <div class="flex items-center">
                                <label for="" class="flex-shrink-0 mr-2 font-medium text-gray-900 text-sm"> Sort
                                    by: </label>
                                <select name=""
                                    class="block focus:shadow mr-4 p-1 pr-10 border rounded-lg outline-none w-full text-base whitespace-pre sm:">
                                    <option class="text-sm whitespace-no-wrap">Recent</option>
                                </select>
                            </div>

                            <button type="button"
                                class="inline-flex items-center bg-white hover:bg-gray-100 shadow focus:shadow px-3 py-2 border border-gray-400 rounded-lg font-medium text-gray-800 text-sm text-center cursor-pointer">
                                <svg class="mr-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        class=""></path>
                                </svg>
                                Export to CSV
                            </button>
                        </div>
                    </div>
                </div>

                <div class="shadow mt-6 border rounded-xl overflow-hidden">
                    <table class="min-w-full border-separate border-spacing-x-2 border-spacing-y-2">
                        <thead class="hidden border-b">
                            <tr class="">
                                <td width="50%" class="py-4 font-medium text-gray-500 text-sm whitespace-normal">
                                    Invoice</td>

                                <td class="py-4 font-medium text-gray-500 text-sm whitespace-normal">Date</td>

                                <td class="py-4 font-medium text-gray-500 text-sm whitespace-normal">Amount</td>

                                <td class="py-4 font-medium text-gray-500 text-sm whitespace-normal">Status</td>
                            </tr>
                        </thead>

                        <tbody class="">

                            @if ($user->count() > 0)
                            @foreach ($withdrawals as $withdrawal )
                            <tr class="">
                                <td width="50%" class="py-4 font-bold text-gray-900 text-sm whitespace-no-wrap">
                                    Withdrawal - {{$withdrawal->updated_at->format('d M H:i')}}

                                    <div class="mt-1">
                                        <p class="font-normal text-gray-500">Payment Option - {{$withdrawal->wallet_name}}</p>
                                    </div>
                                </td>

                                <td class="hidden py-4 font-normal text-gray-500 text-sm whitespace-no-wrap">{{$withdrawal->created_at}}</td>

                                <td class="px-6 py-4 text-gray-600 text-sm text-right whitespace-no-wrap">
                                    ${{$withdrawal->withdrawal_amount}}
                                    <div
                                        class="flex items-center bg-blue-600 mt-1 ml-auto px-3 py-2 rounded-full w-fit font-medium text-white text-xs text-left capitalize">
                                        {{$withdrawal->transaction_status}}</div>
                                </td>

                                <td class="hidden py-4 font-normal text-gray-500 text-sm whitespace-no-wrap">
                                    <div
                                        class="inline-flex items-center bg-blue-600 px-3 py-2 rounded-full text-white text-xs">
                                        {{$withdrawal->transaction_status}}</div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <span class="capitalize">We can't find any withdrawals :(</span>
                        @endif



                        </tbody>
                    </table>
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
