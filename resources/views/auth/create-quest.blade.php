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
        <h1 class="mb-4 font-bold text-2xl">Create Quest</h1>

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

        <form action="{{ route('admin.quest.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="make" class="block font-medium text-gray-700 text-sm">Make:</label>
                <input type="text" name="make" id="make" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="model" class="block font-medium text-gray-700 text-sm">Model:</label>
                <input type="text" name="model" id="model" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="year" class="block font-medium text-gray-700 text-sm">Year:</label>
                <input type="number" name="year" id="year" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="color" class="block font-medium text-gray-700 text-sm">Color:</label>
                <input type="text" name="color" id="color" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="vin" class="block font-medium text-gray-700 text-sm">VIN:</label>
                <input type="text" name="vin" id="vin" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="mileage" class="block font-medium text-gray-700 text-sm">Mileage:</label>
                <input type="number" name="mileage" id="mileage" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="engine_type" class="block font-medium text-gray-700 text-sm">Engine Type:</label>
                <input type="text" name="engine_type" id="engine_type" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="transmission" class="block font-medium text-gray-700 text-sm">Transmission:</label>
                <input type="text" name="transmission" id="transmission" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="fuel_type" class="block font-medium text-gray-700 text-sm">Fuel Type:</label>
                <input type="text" name="fuel_type" id="fuel_type" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="price" class="block font-medium text-gray-700 text-sm">Task Cost:</label>
                <input type="number" name="task_cost" id="" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>
            <div class="mb-4">
                <label for="price" class="block font-medium text-gray-700 text-sm">Task Reward:</label>
                <input type="number" name="task_reward" id="" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>
            <div class="mb-4">
                <label for="price" class="block font-medium text-gray-700 text-sm">Vehicle Market Value:</label>
                <input type="number" name="vmv" id="vmv" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full">
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium text-gray-700 text-sm">Description:</label>
                <textarea name="description" id="description" required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full"></textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block font-medium text-gray-700 text-sm">Upload Images:</label>
                <input type="file" name="image[]" id="image"  required class="block mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 w-full" accept=".jpg, .png, .webp, .jpeg" >
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.quest.list') }}" class="text-blue-600 hover:underline">Back</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-white">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
