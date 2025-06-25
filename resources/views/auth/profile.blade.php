@extends('layouts.app')
@section('title', 'User Profile Management')
@section('content')
    <section x-data="{profile: false, terminateProfile: false}" class="flex justify-center items-center">
        <div class="relative w-[100%]">
            <!-- Header Section with Background Image -->
            <div class="flex justify-center items-end bg-blue-900 bg-cover bg-center min-h-[70vh]"
                style="background-image: url('images/sectionimage.jpeg');">

                <!-- User Welcome Section -->
                <div
                    class="flex flex-col justify-between items-center bg-opacity-90 bg-cover bg-center px-4 py-3 rounded w-full text-white capitalize">

                    {{-- <div class="flex justify-between items-center bg-opacity-90 bg-cover bg-center my-2 px-4 py-3 rounded w-full text-white capitalize"
                        style="background: linear-gradient(90deg, #3a96ecad 0%, #3a96ecad 100%), url('images/bg-image.jpg');">





                        <div x-data="{tooltip: false}" class="relative my-2 w-2/3" >
                            <h3 class="flex gap-1 text-sm">
                                <span>Total Earnings</span>
                                <span @click="tooltip = !tooltip" class="mdi-information-box-outline mdi"></span>

                            </h3>
                            <div x-transition x-show="tooltip" @click.outside="tooltip = false" class="hover:block top-6 left-0 z-10 absolute bg-white shadow-lg p-2 rounded-md w-[200px] text-black">
                                    <p class="text-xs poppins-light">- Your total earings from completed tasks.</p>
                                    <p class="my-1 text-xs poppins-light">- Be sure to complete tasks for more daily rewards.</p>
                                    <p class="text-xs poppins-light">- Please ensure your wallet address is correct.</p>
                                </div>
                            <p class="font-bold poppins-medium">$ 0.00</p>
                        </div>


                        <div class="flex flex-col justify-center items-end gap-1 rounded-full w-1/3">


                            <img class="h-[50px]" src="{{asset('./images/coin.svg')}}" alt="">

                        </div>

                    </div> --}}

                    <div class="flex justify-between items-center bg-opacity-90 bg-cover bg-center my-2 px-4 py-3 rounded w-full text-white capitalize"
                        style="background: linear-gradient(90deg, #3a96ecad 0%, #3a96ecad 100%), url('images/bg-image.jpg');">





                        <div x-data="{tooltip: false}" class="relative my-2 w-2/3" >
                            <h3 class="w-[100px] text-sm truncate">
                                <span>Earnings</span>
                                <span @click="tooltip = !tooltip" class="mdi-information-box-outline mdi"></span>

                            </h3>
                            <div x-transition x-show="tooltip" @click.outside="tooltip = false" class="hover:block top-6 left-0 z-10 absolute bg-white shadow-lg p-2 rounded-md w-[200px] text-black">
                                    <p class="text-xs poppins-light">- Your current withdrawable balance is displayed here.</p>
                                    <p class="my-1 text-xs poppins-light">- You can withdraw your balance to your wallet.</p>
                                    <p class="text-xs poppins-light">- Please ensure your wallet address is correct.</p>
                                </div>
                                <p class="font-bold {{ $user->questJob && ($user->questJob->earnings ?? 0) > 0 ? 'text-green-400' : 'text-red-400' }} poppins-medium">
                                    ${{ $user->questJob ? $user->questJob->earnings ?? '0.00' : '0.00' }}
                                </p>
                        </div>


                        <div class="flex flex-col justify-center items-end gap-1 rounded-full w-1/3">
                            <img class="h-[50px]" src="{{asset('./images/wallet-colored.svg')}}" alt="">



                        </div>

                    </div>

                    <div class="flex justify-between items-center bg-opacity-90 bg-cover bg-center my-2 px-4 py-3 rounded w-full text-white capitalize"
                        style="background: linear-gradient(90deg, #3a96ecad 0%, #3a96ecad 100%), url('images/bg-image.jpg');">





                        <div x-data="{tooltip: false}" class="relative my-2 w-2/3" >
                            <h3 class="flex gap-1 text-sm">
                                <span>Credit Balance</span>
                                <span @click="tooltip = !tooltip" class="mdi-information-box-outline mdi"></span>

                            </h3>
                            <div x-transition x-show="tooltip" @click.outside="tooltip = false" class="hover:block top-6 left-0 z-10 absolute bg-white shadow-lg p-2 rounded-md w-[200px] text-black">You must have a balance exceeding the required cost for the task; this field displays that balance.</p>
                                    <p class="my-1 text-xs poppins-light">- If you ever run low on credit remember to top up your wallet.</p>
                                </div>
                                <p class="font-bold {{ $user->userWallet && $user->userWallet->wallet_balance > 0 ? 'text-green-400' : 'text-red-400' }} poppins-medium">
                                    {{ $user->userWallet ? '$' . $user->userWallet->wallet_balance : '$0.00' }}
                                </p>
                        </div>


                        <div class="flex flex-col justify-center items-end gap-1 rounded-full w-1/3">

                            <img class="h-[50px]" src="{{asset('./images/meter.svg')}}" alt="">


                        </div>

                    </div>


                </div>
            </div>


            <div class="flex justify-between items-center bg-gray-100 mx-3 mt-5 p-4 border border-gray-600 rounded-md">
                <h2 class="mb-4 text-gray-800 text-base poppins-medium">Edit Profile</h2>
                <button @click="profile = !profile" id="update-profile" class="bg-blue-600 hover:bg-blue-800 px-3 py-2 rounded-sm text-white">Edit</button>
            </div>


            <div class="mx-3 mt-5 border border-gray-600 rounded-md" >
                <div class="flex justify-between items-center gap-2 p-4">
                    <span class="font-medium text-gray-900 text-sm">Profile Image</span>
                    <img class="rounded-full h-[60px]" src="{{$user->display_pic ? asset(''): $profilePic}}" alt="">
                </div>
                <div class="flex justify-between items-center gap-2 p-4">
                    <span class="text-gray-900 text-sm poppins-medium">Referral Code</span>
                    <div class="text-sm copyButton poppins-light" data-text-id="referralCode2">
                        <span id="referralCode2" class="textToCopy">{{ $user->referral_code }}</span>
                        <span class="mdi-content-copy mdi"></span>
                    </div>
                </div>
                <div class="flex justify-between items-center gap-2 p-4">
                    <span class="text-gray-900 text-sm poppins-medium">Gender</span>
                    <span class="text-sm poppins-light">
                        Male
                    </span>
                </div>
            </div>

            <div class="mx-3 mt-5 border border-gray-600 rounded-md">
                <div class="flex justify-between items-center gap-2 p-4">
                    <span class="text-gray-900 text-sm poppins-medium">Email</span>
                    <span class="text-sm poppins-light">
                        {{$user->email}}
                    </span>
                </div>
                <div class="flex justify-between items-center gap-2 p-4">
                    <span class="text-gray-900 text-sm poppins-medium">Phone Number</span>
                    <span class="text-sm poppins-light">
                        {{$user->contact_no}}
                    </span>
                </div>
                {{-- <div class="flex justify-between items-center gap-2 p-4">
                    <span class="text-gray-900 text-sm poppins-medium">
                        Address
                    </span>
                    <span class="text-sm poppins-light">
                        US
                    </span>
                </div> --}}
            </div>

            <div class="flex justify-between items-center bg-gray-100 mx-3 mt-5 p-4 border border-gray-600 rounded-md">
                <h2 class="mb-4 text-gray-800 text-base poppins-medium">Terminate Account </h2>
                <div  @click="terminateProfile = !terminateProfile" class="bg-red-600 hover:bg-red-800 px-3 py-2 rounded-sm text-white cursor-pointer">Delete</div>

            </div>

            {{-- Update Profile picture modal --}}
            <div x-transition x-show="profile" @click.outside="profile = !profile" id="profile"  class="z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 mx-auto max-w-[425px]">
                <form  class="bg-white shadow-lg p-6 rounded-lg w-[80%] h-[70vh] overflow-y-auto">
                    <h2 class="flex justify-between gap-2 mb-4 w-full text-base poppins-bold">
                        <span class="w-[70%] capitalize">Update your profile information</span>
                        <span @click="profile = !profile" class="text-red-700 cursor-pointer mdi mdi-close"></span>
                    </h2>
                    <div>
                        <label class="mb-4 text-gray-700 text-sm poppins-medium">Name</label>
                        <input type="text" name="name" value="{{old('name')}}"  class="mb-4 py-1 border-gray-600 border-b outline-none w-full">
                    </div>

                    <div>
                        <label class="mb-4 text-gray-700 text-sm poppins-medium">Email</label>
                        <input type="email" name="email" value="{{old('email')}}"  class="mb-4 py-1 border-gray-600 border-b outline-none w-full">
                    </div>
                    <div>
                        <label class="mb-4 text-gray-700 text-sm poppins-medium">Contact</label>
                        <input type="tel" name="contact_no" value="{{old('contact_no')}}"  class="mb-4 py-1 border-gray-600 border-b outline-none w-full">
                    </div>
                  {{--   <div>
                        <label class="mb-4 text-gray-700 text-sm poppins-medium">Address</label>
                        <input type="text"  class="mb-4 py-1 border-gray-600 border-b outline-none w-full">
                    </div> --}}
                    <div>
                        <label class="mb-4 text-gray-700 text-sm poppins-medium">Gender</label>

                        <select name="" class="mb-4 py-1 border-gray-600 border-b outline-none w-full">
                            <option class="bg-white hover:bg-blue-100 text-gray-900 hover:text-blue-700 transition-colors duration-150" value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-4 text-gray-700 text-sm poppins-medium">Update Profile Picture</label>
                        <input type="file" accept="image/*" class="mb-4 p-2 border rounded-md w-full">
                    </div>

                    <button  class="bg-blue-600 hover:bg-blue-800 mt-4 px-4 py-2 rounded-md w-full text-white">Update</button>
                    <div @click="profile = !profile" class="bg-gray-300 hover:bg-gray-400 mt-2 px-4 py-2 rounded-md w-full text-gray-800 text-center cursor-pointer">Cancel</div>
                </form>

            </div>

            {{-- Delete your profile --}}
            <div x-transition x-show="terminateProfile" @click.outside="terminateProfile = !terminateProfile" id="delete-profile"  class="z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 mx-auto max-w-[425px]">
                <form  class="bg-white shadow-lg p-6 rounded-lg w-[80%] h-fit">
                    <h2 class="flex justify-between gap-2 mb-4 w-full text-base poppins-bold">
                        <span class="w-[70%] capitalize">Terminate your profile</span>
                        <span  @click="terminateProfile = !terminateProfile" class="text-red-700 cursor-pointer mdi mdi-close"></span>
                    </h2>
                    <p class="mb-4 text-gray-700 text-sm poppins-light">Are you sure you want to terminate your account? This action cannot be undone.</p>
                    <div class="relative">
                        <input id="password" class="block shadow-sm px-3 py-2 border border-gray-300 focus:border-indigo-500 rounded-md focus:ring-indigo-500 w-full transition duration-200 password-inputmt-1" type="password" placeholder="Your password" name="password" required autocomplete="current-password" />
                        <div class="top-0 right-[5px] absolute mt-3 cursor-pointer" onclick="togglePasswordVisibility('password')">
                            <img class="hidden password-visible h-[20px]" src="{{ asset('./images/eye-open.svg') }}" alt="Show Password">
                            <img class="password-hidden h-[20px]" src="{{ asset('./images/eye-closed.svg') }}" alt="Hide Password">
                        </div>
                    </div>
                    <button @click="showModal = false" class="bg-red-600 hover:bg-red-800 mt-4 px-4 py-2 rounded-md w-full text-white">Delete Account</button>
                    <div  @click="terminateProfile = !terminateProfile" class="bg-blue-600 hover:bg-blue-800 mt-4 px-4 py-2 rounded-md w-full text-white text-center cursor-pointer">Cancel</div>
                </form>

            </div>

            {{-- Update Profile picture modal --}}
            {{-- <div id="profile-picture"  class="hidden z-50 fixed inset-0 justify-center items-center bg-black bg-opacity-50 fle">
                <div  class="bg-white shadow-lg p-6 rounded-lg w-[400px]">
                    <h2 class="mb-4 font-bold text-lg">Update Profile Picture</h2>
                    <input type="file" accept="image/*" class="mb-4 p-2 border rounded-md w-full">
                    <button @click="showModal = false" class="bg-blue-600 hover:bg-blue-800 mt-4 px-4 py-2 rounded-md w-full text-white">Update</button>
                    <button @click="showModal = false" class="bg-gray-300 hover:bg-gray-400 mt-2 px-4 py-2 rounded-md w-full text-gray-800">Cancel</button>
                </div>

            </div> --}}






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
