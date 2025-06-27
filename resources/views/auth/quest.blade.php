@extends('layouts.app')
@section('title', 'Complete HypeWhip Task To Earn Rewards')
@section('content')
    <section class="flex justify-center items-center">
        <div class="w-[100%]">
            <div class="flex justify-center items-end bg-blue-900 bg-cover bg-center min-h-[50vh] max-h-[60vh]"
                style="background-image: url('images/quest-bg.jpg');">



                <!-- User Welcome Section -->

                <div
                    class="flex flex-col justify-between items-center bg-opacity-90 bg-cover bg-center px-4 py-3 rounded w-[100%] text-white capitalize">


                    <div class="flex justify-between items-center bg-opacity-90 bg-cover bg-center my-2 px-4 py-3 rounded w-[100%] text-white capitalize"
                        style="background: linear-gradient(90deg, #3a96ecad 0%, #3a96ecad 100%), url('images/blue-texture.jpg');">
                        <div>
                            <p class="font-bold tracking-wider">Hi John Doe!</p>
                            <h3 class="text-sm tracking-wide poppins-light">Explore Your Daily Task For Rewards,</h3>
                        </div>
                        <div>
                            <img class="w-[50px]" src="{{ asset('./images/quest.jpg') }}" alt="">
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










            <div class="mx-auto mt-8 px-2">
                <style>
                    .card {
                        width: 250px;
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


                <h2 class="text-2xl text-center capitalize poppins-medium">Your Daily Tasks</h2>

                @if (isset($message))
                    <div class="py-3 text-center alert alert-info">
                        {{ $message }}
                    </div>
                @elseif ($taskData)


                    <div class="relative flex justify-between items-center mt-4">
                        @foreach ($taskList as $index => $task)
                            @php
                                $image = json_decode($task->image, true);
                                $currentTaskPosition =
                                    ($taskList->currentPage() - 1) * $taskList->perPage() + ($index + 1);
                            @endphp
                            <div x-data="{ reviewModal: false }" class="mx-auto" id="card-items">
                                <div class="card">
                                    <div class="flex flex-col justify-between items-center gap-2 card__content">
                                        <div class="w-full max-h-1/3">
                                            <img class="w-full h-[150px] object-cover"
                                                src="{{ asset('./images/quests/' . basename($image[0])) }}"
                                                alt="{{ $image[0] }}">
                                        </div>
                                        <div class="flex flex-col justify-center items-center h-2/3">
                                            <h3 class="font-bold text-base">{{ $task->make }}</h3>
                                            <p>Year: {{ $task->year }}</p>
                                            <p>Price: ${{ number_format($task->price) }}</p>
                                            <p>Mileage: {{ $task->mileage }} MPG</p>
                                            <code>{{ $currentTaskPosition }}/38</code>
                                            <!-- Display current task position -->
                                        </div>
                                        <button @click="reviewModal = !reviewModal" class="view-more">Review</button>
                                    </div>
                                </div>

                                {{-- Review Modal --}}
                                <div x-transition x-show="reviewModal" @click.outside="reviewModal = !reviewModal"
                                    id="reviewModal"
                                    class="z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 mx-auto max-w-[425px]">
                                    <form method="post" action="{{route('tasks.store')}}" class="bg-white shadow-lg p-6 rounded-lg w-[80%] h-[70vh] overflow-y-auto">
                                        @csrf
                                        <h2 class="flex justify-between gap-2 mb-4 w-full text-base poppins-bold">
                                            <span class="w-[70%] capitalize">Submit your review</span>
                                            <span @click="reviewModal = !reviewModal"
                                                class="text-red-700 cursor-pointer mdi mdi-close"></span>
                                        </h2>
                                        <div>
                                            <div class="mb-4">
                                                <h2 class="mb-2 border-gray-500 border-b font-bold text-xl oleo-script-bold">Popular Information on This Vehicle</h2>
                                                <div class="flex flex-col gap-2">
                                                    <p class="text-sm poppins-regular">Mileage: <span class="font-semibold">{{ $task->mileage }} MPG</span></p>
                                                    <p class="text-sm poppins-regular">Engine Type: <span class="font-semibold">{{ $task->engine_type }}</span></p>
                                                    <p class="text-sm poppins-regular">Transmission: <span class="font-semibold">{{ $task->transmission }}</span></p>
                                                    <p class="text-sm poppins-regular">Fuel Type: <span class="font-semibold">{{ $task->fuel_type }}</span></p>
                                                    <p class="text-sm poppins-regular">Price: <span class="font-semibold">${{ number_format($task->price) }}</span></p>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <h2 class="mb-2 border-gray-500 border-b font-bold text-xl oleo-script-bold">Task Requirements</h2>
                                                <p class="text-gray-700">
                                                    To complete this task, you must maintain a credit balance of at least <span class="font-semibold">${{ $task->quest_cost }}</span>.
                                                </p>
                                                <p class="text-gray-700">
                                                    Quest Commission: <span class="font-semibold">{{ $task->quest_commission }}%</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div>
                                            <input type="text" name="quest_cost" value="{{$task->quest_cost}}" hidden>
                                            <input type="text" name="quest_commission" value="{{$task->quest_commission}}" hidden>
                                        </div>
                                        <div>
                                            <label class="mb-4 text-gray-700 text-sm poppins-medium">Tell us what you think</label>
                                            <textarea name="comment" class="mb-4 py-1 border border-gray-600 outline-none w-full">{{ old('comment') }}</textarea>
                                        </div>

                                        <div>
                                            <label class="mb-4 text-gray-700 text-sm poppins-medium">Leave a rating</label>
                                            <div class="flex items-center" id="star-rating">
                                                <svg class="ms-1 w-4 h-4 text-gray-300 star" data-index="1"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                                <svg class="ms-1 w-4 h-4 text-gray-300 star" data-index="2"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                                <svg class="ms-1 w-4 h-4 text-gray-300 star" data-index="3"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                                <svg class="ms-1 w-4 h-4 text-gray-300 star" data-index="4"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                                <svg class="ms-1 w-4 h-4 text-gray-300 star" data-index="5"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 22 20">
                                                    <path
                                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </div>


                                        </div>

                                        <button
                                            class="bg-blue-600 hover:bg-blue-800 mt-4 px-4 py-2 rounded-md w-full text-white">Update</button>
                                        <div @click="reviewModal = !reviewModal"
                                            class="bg-gray-300 hover:bg-gray-400 mt-2 px-4 py-2 rounded-md w-full text-gray-800 text-center cursor-pointer">
                                            Cancel</div>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        {{ $taskList->links('vendor.pagination.paginator') }} <!-- Pagination links -->
                    </div>
                @endif
            </div>



            <div class="mx-3 mt-8 mb-2">
                <h2 class="mt-4 mb-3 text-2xl text-center capitalize poppins-medium">
                    Find information on your favourite ride
                </h2>

                <div class="bg-gray-800 text-gray-100">
                    <div class="bg-gray-900 shadow-sm mx-auto px-10 py-6 rounded-lg max-w-4xl container">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400 text-sm">Jun 1, 2020</span>
                            <a rel="noopener noreferrer" href="#"
                                class="bg-violet-400 px-2 py-1 rounded font-bold text-gray-900">Javascript</a>
                        </div>
                        <div class="mt-3">
                            <a rel="noopener noreferrer" href="#" class="font-bold text-2xl hover:underline">Nos
                                creasse pendere crescit angelos etc</a>
                            <p class="mt-2">Tamquam ita veritas res equidem. Ea in ad expertus paulatim poterunt. Imo volo
                                aspi novi tur. Ferre hic neque vulgo hae athei spero. Tantumdem naturales excaecant
                                notaverim etc cau perfacile occurrere. Loco visa to du huic at in dixi aër.</p>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <a rel="noopener noreferrer" href="#" class="text-violet-400 hover:underline">Read
                                more</a>
                            <div>
                                <a rel="noopener noreferrer" href="#" class="flex items-center">
                                    <img src="https://source.unsplash.com/50x50/?portrait" alt="avatar"
                                        class="bg-gray-500 mx-4 rounded-full w-10 h-10 object-cover">
                                    <span class="text-gray-400 hover:underline">Leroy Jenkins</span>
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
            <div class="hidden gap-2 grid-cols-2 mt-7 gri">
                <!-- Agent Level Card (Repeated 3 times) -->
                <div class="bg-blue-500 py-2 border-2 rounded-lg max-w-[170px] text-white">
                    <h3 class="font-medium text-md text-center capitalize">Trial period agent</h3>
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


            </div>

            <script>
                const stars = document.querySelectorAll('.star');

                stars.forEach(star => {
                    star.addEventListener('click', () => {
                        const index = star.getAttribute('data-index');

                        // Toggle stars based on the index
                        stars.forEach((s, i) => {
                            s.classList.toggle('text-yellow-300', i < index);
                            s.classList.toggle('text-gray-300', i >= index);
                        });
                    });
                });
            </script>


        </div>
    </section>
@endsection
