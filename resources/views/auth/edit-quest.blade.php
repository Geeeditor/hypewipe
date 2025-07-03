<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quest</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex justify-center items-center bg-gray-100 min-h-screen">
    <div class="bg-white shadow-md p-6 rounded-lg w-full max-w-lg">
        <h1 class="mb-4 font-bold text-2xl">Edit Quest</h1>

        @if(session('success'))
            <div class="bg-green-200 mb-4 p-2 rounded text-green-700">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="bg-red-200 mb-4 p-2 rounded text-red-700">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('admin.quest.update', [ 'id' => $task->id ])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="make" class="block font-medium text-gray-700 text-sm">Make:</label>
                <input type="text" name="make" id="make" value="{{$task->make}}" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="model" class="block font-medium text-gray-700 text-sm">Model:</label>
                <input type="text" name="model" id="model" value="{{$task->model}}" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="year" class="block font-medium text-gray-700 text-sm">Year:</label>
                <input type="number" name="year" id="year" value="{{$task->year}}" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="color" class="block font-medium text-gray-700 text-sm">Color:</label>
                <input type="text" name="color" id="color" value="{{$task->color}}" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="vin" class="block font-medium text-gray-700 text-sm">VIN:</label>
                <input type="text" name="vin" id="vin" value="{{$task->vin}}" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="mileage" class="block font-medium text-gray-700 text-sm">Mileage:</label>
                <input type="number" name="mileage" id="mileage" value="{{$task->mileage}}" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="engine_type" class="block font-medium text-gray-700 text-sm">Engine Type:</label>
                <input type="text" name="engine_type" value="{{$task->engine_type}}" id="engine_type" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="transmission" class="block font-medium text-gray-700 text-sm">Transmission:</label>
                <input type="text" name="transmission" value="{{$task->transmission}}" id="transmission" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="fuel_type" class="block font-medium text-gray-700 text-sm">Fuel Type:</label>
                <input type="text" name="fuel_type" id="fuel_type" value="{{$task->fuel_type}}" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="price" class="block font-medium text-gray-700 text-sm">Task Cost:</label>
                <input type="number" name="task_cost" id="" value="{{$task->task_cost}}" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>
            <div class="mb-4">
                <label for="price" class="block font-medium text-gray-700 text-sm">Task Reward:</label>
                <input type="number" name="task_reward" value="{{$task->task_reward}}" id="" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>
            <div class="mb-4">
                <label for="price" class="block font-medium text-gray-700 text-sm">Vehicle Market Value:</label>
                <input type="number" name="vmv" id="vmv" value="{{$task->vmv}}" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium text-gray-700 text-sm">Description:</label>
                <textarea name="description" id="description" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">{{ $task->description }}
                </textarea>

               {{--  <script>
                    document.getElementById('description').addEventListener('input', function() {
                        this.value = this.value.replace(/^\s+/, ''); // Remove leading whitespace
                    });
                </script> --}}
            </div>

            <div class="mb-4">
                <label for="image" class="block font-medium text-gray-700 text-sm">Current Hero Image:</label>
                @php
                    $image = $task->image === null ? [] : json_decode($task->image);
                @endphp

                @foreach($image as $imageName)
                    <div>
                        <div class="aspect-h-1 aspect-w-1">
                            <img src="{{ asset('/images/quests/' . basename($imageName)) }}" alt="Room Image" class="rounded-lg h-[100px]">
                        </div>
                        <div class="hidden items-center gap-2 mt-2 fle">
                            <input class="w-[15px] h-[15px]" type="checkbox" name="deleted_image[]" value="{{ $imageName }}" id="checkbox-{{ $loop->index }}">
                            <p class="font-medium text-lg capitalize">Delete Image</p>
                        </div>
                    </div>
                @endforeach

                <input type="file" name="image[]" id="image"  class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full" accept=".jpg, .png, .webp, .jpeg">

                <script>
                    document.getElementById('image').addEventListener('change', function() {
                        // Get the checkboxes corresponding to the uploaded images
                        const checkboxes = document.querySelectorAll('input[name="deleted_image[]"]');

                        // Check the first checkbox (you may adjust this logic as needed)
                        if (checkboxes.length > 0) {
                            checkboxes[0].checked = true; // Check the first checkbox
                        }
                    });
                </script>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.quest.list') }}" class="text-blue-600 hover:underline">Back</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-white">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
