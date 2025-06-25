<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quest</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex min-h-screen items-center justify-center bg-gray-100">
    <div class="w-full max-w-lg rounded-lg bg-white p-6 shadow-md">
        <h1 class="mb-4 text-2xl font-bold">Create Quest</h1>

        @if(session('success'))
            <div class="mb-4 rounded bg-green-200 p-2 text-green-700">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="mb-4 rounded bg-red-200 p-2 text-red-700">
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
                <label for="make" class="block text-sm font-medium text-gray-700">Make:</label>
                <input type="text" name="make" id="make" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="model" class="block text-sm font-medium text-gray-700">Model:</label>
                <input type="text" name="model" id="model" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="year" class="block text-sm font-medium text-gray-700">Year:</label>
                <input type="number" name="year" id="year" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="color" class="block text-sm font-medium text-gray-700">Color:</label>
                <input type="text" name="color" id="color" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="vin" class="block text-sm font-medium text-gray-700">VIN:</label>
                <input type="text" name="vin" id="vin" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="mileage" class="block text-sm font-medium text-gray-700">Mileage:</label>
                <input type="number" name="mileage" id="mileage" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="engine_type" class="block text-sm font-medium text-gray-700">Engine Type:</label>
                <input type="text" name="engine_type" id="engine_type" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="transmission" class="block text-sm font-medium text-gray-700">Transmission:</label>
                <input type="text" name="transmission" id="transmission" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="fuel_type" class="block text-sm font-medium text-gray-700">Fuel Type:</label>
                <input type="text" name="fuel_type" id="fuel_type" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Task Cost:</label>
                <input type="number" name=" quest_cost" id="price" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Task Commission:</label>
                <input type="number" name="quest_commission" id="" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                <input type="number" name="price" id="price" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea name="description" id="description" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500"></textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Upload Images:</label>
                <input type="file" name="image[]" id="image"  required class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-blue-500" accept=".jpg, .png, .webp, .jpeg" multiple>
            </div>

            <div class="flex justify-between">
                <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">Back</a>
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
