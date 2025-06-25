@extends('layouts.app')
@section('title', 'Withdrawal')
@section('content')
    <section class="flex items-center justify-center">
        <div class="w-[100%]">
            <!-- Header Section with Background Image -->
            <div class="flex max-h-[60vh] min-h-[50vh] items-end justify-center bg-blue-900 bg-cover bg-center"
                style="background-image: url('images/wallet-bg.jpg');">

                <!-- User Welcome Section -->
                <div
                    class="flex w-full flex-col items-center justify-between rounded bg-opacity-90 bg-cover bg-center px-4 py-3 capitalize text-white">

                    <div class="my-2 flex w-full items-center justify-between rounded bg-opacity-90 bg-cover bg-center px-4 py-3 capitalize text-white"
                        style="background: linear-gradient(90deg, #3a96ecad 0%, #3a96ecad 100%), url('images/blue-texture.jpg');">





                        <div x-data="{tooltip: false}" class="relative my-2 w-2/3" >
                            <h3 class="flex gap-1 text-sm">
                                <span>Total Earnings</span>
                                <span @click="tooltip = !tooltip" class="mdi-information-box-outline mdi"></span>

                            </h3>
                            <div x-transition x-show="tooltip" @click.outside="tooltip = false" class="absolute left-0 top-6 z-10 w-[200px] rounded-md bg-white p-2 text-black shadow-lg hover:block">
                                    <p class="poppins-light text-xs">- Your current balance is displayed here.</p>
                                    <p class="poppins-light my-1 text-xs">- You can withdraw your balance to your wallet.</p>
                                    <p class="poppins-light text-xs">- Please ensure your wallet address is correct.</p>
                                </div>
                            <p class="poppins-medium font-bold">$ {{  $user->questJob ?  $taskData->earnings ?? '0.00' : '0.00'}} </p>
                        </div>


                        <div class="flex w-1/3 flex-col items-end justify-center gap-1 rounded-full">
                            <img class="h-[70px]" src="{{asset('./images/wallet-colored.svg')}}" alt="">


                        </div>

                    </div>


                    <div
                        class="my-2 flex w-full justify-between rounded-md border border-gray-300 bg-slate-100 px-1 py-3 text-gray-900 shadow-sm shadow-gray-700">
                        <div class="flex flex-col items-start justify-start">
                            <span class="poppins-light text-[70%]">Credit Balance</span>
                            <span class="poppins-medium text-sm">
                                {{ $user->userWallet ? '$' . $user->userWallet->wallet_balance ?? 'No wallet :)' : 'No wallet :)' }}
                            </span>
                        </div>
                        
                        <div class="flex flex-col items-start justify-start border-x border-gray-300 px-5">
                            <span class="poppins-light text-[70%]">Withdrawals</span>
                            <span class="poppins-medium text-sm">{{ $withdrawals->count()}}</span>
                        </div>
                        <div class="flex flex-col items-start justify-start">
                            <span class="poppins-light text-[70%]">Deposits</span>
                            <span class="poppins-medium text-sm">{{ $userDeposits->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>





            <form method="post" class="mx-3 mt-5 rounded-lg" action="{{route('withdraw.store')}}">
                @csrf
                <h2 class="poppins-medium mb-4 text-base text-gray-800">Withdraw</h2>

                <div>
                    <label for="wallet_address" class="block text-sm font-medium text-gray-700">Withdrawal Amount</label>
                    <input id="wallet_amount"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm transition duration-200 focus:border-indigo-500 focus:ring-indigo-500"
                        type="text" name="debit_amount" placeholder="Enter amount to withdraw" required
                        autocomplete="debit_amount" />
                </div>
                <input id="wallet_id"
                class="mt-1 hidden w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm transition duration-200 focus:border-indigo-500 focus:ring-indigo-500"
                type="text" name="wallet_id" hidden value="{{$userWallet->wallet_id}}" placeholder="Enter amount to withdraw" readonly
                autocomplete="wallet_id" />

                <div class="mt-4">
                    <label for="wallet_type" class="block text-sm font-medium capitalize text-gray-700">
                        <span> Withdrawal address</span>
                        <a href="{{route('wallet')}}">
                        <span class="mdi mdi-plus-box"></span></a>
                    </label>



                    <select id="wallet_type" name="wallet_address"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm transition duration-200 focus:border-indigo-500 focus:ring-indigo-500"
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
                    <label for="wallet_pin" class="block text-sm font-medium text-gray-700">Enter your Wallet Pin</label>


                        <div class="relative">
                            <input id="password" class="password-inputmt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm transition duration-200 focus:border-indigo-500 focus:ring-indigo-500" type="password" name="wallet_pin" required autocomplete="wallet_pin" />
                            <div class="absolute right-[5px] top-0 mt-3 cursor-pointer" onclick="togglePasswordVisibility('password')">
                                <img class="password-visible hidden h-[20px]" src="{{ asset('./images/eye-open.svg') }}" alt="Show Password">
                                <img class="password-hidden h-[20px]" src="{{ asset('./images/eye-closed.svg') }}" alt="Hide Password">
                            </div>
                        </div>
                    <div class="mt-2 text-sm text-red-600">
                        <!-- Error messages for wallet name -->
                        <!-- Example: <span>Invalid wallet name.</span> -->
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full rounded-md bg-indigo-600 px-4 py-2 font-semibold text-white shadow transition duration-200 hover:bg-indigo-700">
                        Submit
                    </button>
                </div>
            </form>




            <div class="mx-auto mt-8 px-2">
                <div class="flex-col">
                    <h2 class="poppins-medium flex-1 text-gray-900">Latest Withdrawals</h2>

                    <div class="mt-4">
                        <div class="flex items-center justify-start">
                            <div class="flex items-center">
                                <label for="" class="mr-2 flex-shrink-0 text-sm font-medium text-gray-900"> Sort
                                    by: </label>
                                <select name=""
                                    class="sm: mr-4 block w-full whitespace-pre rounded-lg border p-1 pr-10 text-base outline-none focus:shadow">
                                    <option class="whitespace-no-wrap text-sm">Recent</option>
                                </select>
                            </div>

                            <button type="button"
                                class="inline-flex cursor-pointer items-center rounded-lg border border-gray-400 bg-white px-3 py-2 text-center text-sm font-medium text-gray-800 shadow hover:bg-gray-100 focus:shadow">
                                <svg class="mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
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

                <div class="mt-6 overflow-hidden rounded-xl border shadow">
                    <table class="min-w-full border-separate border-spacing-x-2 border-spacing-y-2">
                        <thead class="hidden border-b">
                            <tr class="">
                                <td width="50%" class="whitespace-normal py-4 text-sm font-medium text-gray-500">
                                    Invoice</td>

                                <td class="whitespace-normal py-4 text-sm font-medium text-gray-500">Date</td>

                                <td class="whitespace-normal py-4 text-sm font-medium text-gray-500">Amount</td>

                                <td class="whitespace-normal py-4 text-sm font-medium text-gray-500">Status</td>
                            </tr>
                        </thead>

                        <tbody class="">

                            @if ($withdrawals->count() > 0)
                            @foreach ($withdrawals as $withdrawal )
                            <tr class="">
                                <td width="50%" class="whitespace-no-wrap py-4 text-sm font-bold text-gray-900">
                                    Deposit - {{$withdrawal->updated_at->format('d M H:i')}}

                                    <div class="mt-1">
                                        <p class="font-normal text-gray-500">Payment Option - {{$withdrawal->wallet_name}}</p>
                                    </div>
                                </td>

                                <td class="whitespace-no-wrap hidden py-4 text-sm font-normal text-gray-500">{{$withdrawal->created_at}}</td>

                                <td class="whitespace-no-wrap px-6 py-4 text-right text-sm text-gray-600">
                                    ${{$withdrawal->withdrawal_amount}}
                                    <div
                                        class="ml-auto mt-1 flex w-fit items-center rounded-full bg-blue-600 px-3 py-2 text-left text-xs font-medium capitalize text-white">
                                        {{$withdrawal->transaction_status}}</div>
                                </td>

                                <td class="whitespace-no-wrap hidden py-4 text-sm font-normal text-gray-500">
                                    <div
                                        class="inline-flex items-center rounded-full bg-blue-600 px-3 py-2 text-xs text-white">
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

            <div class="mx-3 mb-2 mt-[1.5em] hidden">
                <h2 class="text-lg font-bold capitalize">online travel agent level</h2>

                <!-- Agent Level Cards Grid -->
                <div class="mt-7 grid grid-cols-2 gap-2">
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

                    <!-- Duplicate cards removed for brevity (same structure as above) -->
                    <!-- ... -->
                </div>
            </div>
        </div>
    </section>
@endsection
