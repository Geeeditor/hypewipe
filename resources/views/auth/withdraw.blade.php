@extends('layouts.app')
@section('title', 'Withdrawal')
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
                            <h3 class="flex gap-1 text-sm">
                                <span>Total Earnings</span>
                                <span @click="tooltip = !tooltip" class="mdi-information-box-outline mdi"></span>

                            </h3>
                            <div x-transition x-show="tooltip" @click.outside="tooltip = false" class="hover:block top-6 left-0 z-10 absolute bg-white shadow-lg p-2 rounded-md w-[200px] text-black">
                                    <p class="text-xs poppins-light">- Your current balance is displayed here.</p>
                                    <p class="my-1 text-xs poppins-light">- You can withdraw your balance to your wallet.</p>
                                    <p class="text-xs poppins-light">- Please ensure your wallet address is correct.</p>
                                </div>
                            <p class="font-bold poppins-medium">$ {{  $user->questJob ?  $taskData->earnings ?? '0.00' : '0.00'}} </p>
                        </div>


                        <div class="flex flex-col justify-center items-end gap-1 rounded-full w-1/3">
                            <img class="h-[70px]" src="{{asset('./images/wallet-colored.svg')}}" alt="">


                        </div>

                    </div>


                    <div
                        class="flex justify-between bg-slate-100 shadow-gray-700 shadow-sm my-2 px-1 py-3 border border-gray-300 rounded-md w-full text-gray-900">
                        <div class="flex flex-col justify-start items-start">
                            <span class="text-[70%] poppins-light">Credit Balance</span>
                            <span class="text-sm poppins-medium">
                                {{ $user->userWallet ? '$' . $user->userWallet->wallet_balance ?? 'No wallet :)' : 'No wallet :)' }}
                            </span>
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





            <form method="post" class="mx-3 mt-5 rounded-lg" action="{{route('withdraw.store')}}">
                @csrf
                <h2 class="mb-4 text-gray-800 text-base poppins-medium">Withdraw</h2>

                <div>
                    <label for="wallet_address" class="block font-medium text-gray-700 text-sm">Withdrawal Amount</label>
                    <input id="wallet_amount"
                        class="block shadow-sm mt-1 px-3 py-2 border border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full transition duration-200"
                        type="text" name="debit_amount" placeholder="Enter amount to withdraw" required
                        autocomplete="debit_amount" />
                </div>
                <input id="wallet_id"
                class="hidden shadow-sm mt-1 px-3 py-2 border border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full transition duration-200"
                type="text" name="wallet_id" hidden value="{{$userWallet->wallet_id}}" placeholder="Enter amount to withdraw" readonly
                autocomplete="wallet_id" />

                <div class="mt-4">
                    <label for="wallet_type" class="block font-medium text-gray-700 text-sm capitalize">
                        <span> Withdrawal address</span>
                        <a href="{{route('wallet')}}">
                        <span class="mdi mdi-plus-box"></span></a>
                    </label>



                    <select id="wallet_type" name="wallet_address"
                        class="block shadow-sm mt-1 px-3 py-2 border border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full transition duration-200"
                        required>
                        @if ($userAvailableWallets->count() > 0)
                            @foreach ($userAvailableWallets as $uaw )
                                                        <option value="{{$uaw->wallet_address}}">{{$uaw->wallet_name}}</option>
                                                    @endforeach
                        @else
                        <option value="No wallet detected">No wallet detected</option>
                        @endif

                    </select>
                </div>

                <div class="mt-4">
                    <label for="wallet_pin" class="block font-medium text-gray-700 text-sm">Enter your Wallet Pin</label>


                        <div class="relative">
                            <input id="password" class="block shadow-sm px-3 py-2 border border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full transition duration-200 password-inputmt-1" type="password" name="wallet_pin" required autocomplete="wallet_pin" />
                            <div class="top-0 right-[5px] absolute mt-3 cursor-pointer" onclick="togglePasswordVisibility('password')">
                                <img class="hidden password-visible h-[20px]" src="{{ asset('./images/eye-open.svg') }}" alt="Show Password">
                                <img class="password-hidden h-[20px]" src="{{ asset('./images/eye-closed.svg') }}" alt="Hide Password">
                            </div>
                        </div>
                    <div class="mt-2 text-red-600 text-sm">
                        <!-- Error messages for wallet name -->
                        <!-- Example: <span>Invalid wallet name.</span> -->
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 shadow px-4 py-2 rounded-md w-full font-semibold text-white transition duration-200">
                        Submit
                    </button>
                </div>
            </form>




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

                            @if ($withdrawals->count() > 0)
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
