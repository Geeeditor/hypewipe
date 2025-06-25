@extends('layouts.app')
@section('title', 'Top Up your wallet')
@section('content')
    <section  x-data="{ payNow: false, wallet: { deposit_amount: '', name: 'No Payment Option Selected' } }" class="flex justify-center items-center">
        <div class="w-[100%]">

            <!-- Header Section with Background Image -->
            <div class="flex justify-center items-end bg-blue-900 bg-cover bg-center min-h-[50vh] max-h-[60vh]"
                style="background-image: url('images/wallet-bg.jpg');">

                <!-- User Welcome Section -->
                <div
                    class="flex flex-col justify-between items-center bg-opacity-90 bg-cover bg-center px-4 py-3 rounded w-full text-white capitalize">

                    <div class="flex justify-between items-center bg-opacity-90 bg-cover bg-center my-2 px-4 py-3 rounded w-full text-white capitalize"
                        style="background: linear-gradient(90deg, #3a96ecad 0%, #3a96ecad 100%), url('images/blue-texture.jpg');">





                        <div x-data="{ tooltip: false }" class="relative my-2 w-2/3">
                            <h3 class="w-[100px] text-sm truncate">
                                <span>Balance</span>
                                <span @click="tooltip = !tooltip" class="mdi-information-box-outline mdi"></span>

                            </h3>
                            <div x-transition x-show="tooltip" @click.outside="tooltip = false"
                                class="hover:block top-6 left-0 z-10 absolute bg-white shadow-lg p-2 rounded-md w-[200px] text-black">
                                <p class="text-xs poppins-light">- Your current balance is displayed here.</p>
                                <p class="my-1 text-xs poppins-light">- You can withdraw your balance to your wallet.</p>
                                <p class="text-xs poppins-light">- Please ensure your wallet address is correct.</p>
                            </div>
                            <p class="font-bold poppins-medium">
                                {{ $user->userWallet ? '$' . $user->userWallet->wallet_balance ?? 'No wallet :)' : 'No wallet :)' }}
                            </p>
                        </div>


                        <div class="flex flex-col justify-center items-end gap-1 rounded-full w-1/3">
                            <img class="h-[70px]" src="{{ asset('./images/wallet-colored.svg') }}" alt="">


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

              {{-- Top Wallet Details Data --}}
              <div class="mx-3 mt-5 rounded-lg">
                <h2 class="mb-4 text-gray-800 text-base capitalize poppins-medium">Top up your account balance</h2>

                <div>
                    <label for="wallet_address" class="block font-medium text-gray-700 text-sm">Amount to Deposit</label>
                    <input id="wallet_address" x-model="wallet.deposit_amount"
                        class="block shadow-sm mt-1 px-3 py-2 border border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full transition duration-200"
                        type="number" name="deposit_amount" placeholder="20.00" required
                        autocomplete="wallet_address" />
                </div>

                <div class="mt-4">
                    <label for="wallet_type" class="block font-medium text-gray-700 text-sm">Choose Crypto Payment Address</label>
                    <select id="walletSelect" x-model="wallet.name"
                        class="block shadow-sm mt-1 px-3 py-2 border border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full transition duration-200"
                        name="wallet_type" required>
                        <option  value="none" >None</option>

                        @foreach ($adminWallets as  $wallet)
                        <option id="payment_address" value="{{$wallet->wallet_address}}" >{{$wallet->wallet_name}}</option>

                        @endforeach
                        {{-- <option value="TRC20" selected>USDT</option> --}}
                        {{-- <option value="ERC20">ERC20</option>
                        <option value="BEP20">BEP20</option> --}}
                    </select>
                </div>

                {{-- <div class="mt-4">
                    <label for="wallet_name" class="block font-medium text-gray-700 text-sm">Wallet Name/Remark</label>
                    <input id="wallet_name" x-model="wallet.name"
                        class="block shadow-sm mt-1 px-3 py-2 border border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full transition duration-200"
                        type="text" name="wallet_name" placeholder="e.g. BTC, USDT" required
                        autocomplete="wallet_name" />
                    <div class="mt-2 text-red-600 text-sm">
                        <!-- Error messages for wallet name -->
                    </div>
                </div> --}}

                <div class="mt-6">
                    <button id="generateQrBtn" @click="payNow = true" type="button"
                        class="bg-indigo-600 hover:bg-indigo-700 shadow px-4 py-2 rounded-md w-full font-semibold text-white transition duration-200">
                        Pay Now
                    </button>
                </div>
            </div>

            {{-- Add Wallet Modal --}}
            <div x-transition x-show="payNow" @click.outside="payNow = false"
                class="z-[998] fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 mx-auto max-w-[425px] overflow-x-hidden overflow-y-scroll">
                <form method="post" action="{{ route('wallet.topup.store') }}" id="form"
                    class="bg-white shadow-lg p-6 rounded-lg w-[80%] h-fit">
                    @csrf
                    <input type="text" name="deposit_amount" x-model="wallet.deposit_amount" hidden>
                    <input type="text" name="wallet_name" x-model="wallet.name" hidden>
                    <h2 class="flex justify-between gap-2 mb-4 w-full text-base poppins-bold">
                        <span class="w-[70%] capitalize">Payment</span>
                        <span @click="payNow = false" class="text-red-700 cursor-pointer mdi mdi-close"></span>
                    </h2>

                    <div  id="qrcode">

                    </div>
                    <div class="flex justify-between items-center">
                      <p class="mb-4 text-gray-700 text-sm poppins-light">You are to pay: </p>
                      <p>
                        $
                        <span x-text="wallet.deposit_amount"></span>
                        </p>
                    </div>

                    <div class="flex justify-between items-center w-full">
                        <p class="mb-4 text-gray-700 text-sm poppins-light">Wallet Address:</p>
                        <p class="flex gap-1 copyAddress">
                            <input name="wallet_address" class="w-[90%]" data-text-id="walletaddress" id="address_value" readonly type="text" x-model="wallet.name">
                            <span class="mdi-content-copy mdi copy-btn" id="copy-btn" style="cursor: pointer;"></span>
                        </p>
                    </div>

                    <script>
                            document.getElementById('copy-btn').addEventListener('click', function() {
                            var inputField = document.getElementById('address_value');

                            // Use the Clipboard API to copy text
                            navigator.clipboard.writeText(inputField.value).then(function() {
                                alert('Wallet address copied: ' + inputField.value);
                            }, function(err) {
                                console.error('Could not copy text: ', err);
                            });
                        });
                    </script>


                    <div>
                        <label for="wallet_address" class="block font-medium text-gray-700 text-sm">Provide Transaction Hash</label>
                        <input
                            class="block shadow-sm mt-1 px-3 py-2 border border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full transition duration-200"
                            type="text" name="transaction_hash" placeholder="d2ea33a47e6ce5a78998cf2fde3c73d262a4bce9fed70aaf7df416fa161ec39f" required
                            autocomplete="transaction_hash" />
                    </div>
                    {{-- <div>
                        <label for="">Wallet Pin</label>
                        <div class="relative">
                            <input id="password" name="wallet_pin"
                                class="block shadow-sm mt-1 px-3 py-2 border border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full transition duration-200 password-input"
                                type="password" required placeholder="Your Wallet Pin" autocomplete="current-password" />
                            <div class="top-0 right-[5px] absolute mt-3 cursor-pointer"
                                onclick="togglePasswordVisibility('password')">
                                <img class="hidden password-visible h-[20px]" src="{{ asset('./images/eye-open.svg') }}"
                                    alt="Show Password">
                                <img class="password-hidden h-[20px]" src="{{ asset('./images/eye-closed.svg') }}"
                                    alt="Hide Password">
                            </div>
                        </div>
                    </div> --}}
                    <button
                        class="bg-blue-600 hover:bg-blue-800 mt-4 px-4 py-2 rounded-md w-full text-white text-center cursor-pointer">Confirm Payment</button>
                    <div @click="payNow = false"
                        class="bg-red-600 hover:bg-red-800 mt-4 px-4 py-2 rounded-md w-full text-white text-center cursor-pointer">
                        Cancel</div>
                </form>
            </div>




            <div class="mx-auto mt-8 px-2">
                <div class="flex-col">
                    <h2 class="flex-1 text-gray-900 poppins-medium">Latest Deposits</h2>

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

                            @if ($userDeposits->count() > 0)
                                @foreach ($userDeposits as $deposit )
                                <tr class="">
                                    <td width="50%" class="py-4 font-bold text-gray-900 text-sm whitespace-no-wrap">
                                        Deposit - {{$deposit->updated_at->format('d M H:i')}}

                                        <div class="mt-1">
                                            <p class="font-normal text-gray-500">Payment Option - {{$deposit->crypto_option}}</p>
                                        </div>
                                    </td>

                                    <td class="hidden py-4 font-normal text-gray-500 text-sm whitespace-no-wrap">{{$deposit->created_at}}</td>

                                    <td class="px-6 py-4 text-gray-600 text-sm text-right whitespace-no-wrap">
                                        ${{$deposit->deposit_amount}}
                                        <div
                                            class="flex items-center bg-blue-600 mt-1 ml-auto px-3 py-2 rounded-full w-fit font-medium text-white text-xs text-left capitalize">
                                            {{$deposit->transaction_status}}</div>
                                    </td>

                                    <td class="hidden py-4 font-normal text-gray-500 text-sm whitespace-no-wrap">
                                        <div
                                            class="inline-flex items-center bg-blue-600 px-3 py-2 rounded-full text-white text-xs">
                                            {{$deposit->transaction_status}}</div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <span class="capitalize">We can't find any deposits :(</span>
                            @endif





                        </tbody>
                    </table>
                </div>
            </div>




            <br>
            <br>
            <br>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js"></script>
        <script>
            document.getElementById('generateQrBtn').addEventListener('click', function() {
                // Get the selected wallet address
                var walletAddress = document.getElementById('walletSelect').value;

                // Generate the QR code
                var qr = qrcode(0, 'L');
                qr.addData(walletAddress); // Use the selected wallet address
                qr.make();

                // Display the QR code
                document.getElementById('qrcode').innerHTML = qr.createImgTag();
            });
        </script>


    </section>

@endsection
