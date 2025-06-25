<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Storage;

class QuestController extends Controller
{
    public function create()
    {
        return view('auth.create-quest');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|string',
            'color' => 'required|string',
            'vin' => 'required|string',
            'mileage' => 'required|numeric',
            'engine_type' => 'required|string',
            'transmission' => 'required|string',
            'fuel_type' => 'required|string',
            'price' => 'required|numeric',
            'quest_cost' => 'required|numeric',
            'quest_commission' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $imageNames = [];

      /*   foreach ($data['image'] as $image) {
            // Create an UploadedFile instance from the uploaded image
            $uploadedFile = new UploadedFile($image->getPathname(), $image->getClientOriginalName());

            // Generate dynamic file name
            $fileName = strtolower($data['make']) . '_' . strtolower($data['model']) . '_' . Str::random(4) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

            // Store the image in the quest folder
            Storage::disk('public')->put('/quests/' . $fileName, file_get_contents($uploadedFile->getRealPath()));
            $imageNames[] = $fileName; // Collect the generated names
        } */

        foreach ($data['image'] as $image) {
            // Generate dynamic file name
            $fileName = strtolower($data['make']) . '_' . strtolower($data['model']) . '_' . Str::random(4) . '_' . time() . '.' . $image->getClientOriginalExtension();

            // Store the image in the quest folder
            Storage::disk('public')->put('/quests/' . $fileName, file_get_contents($image));
            $imageNames[] = $fileName; // Collect the generated names
        }

        // dd($imageNames);



        Quest::create([
            'image' => json_encode($imageNames),
            'make' => $data['make'],
            'model' => $data['model'],
            'year' => $data['year'],
            'color' => $data['color'],
            'vin' => $data['vin'],
            'mileage' => $data['mileage'],
            'engine_type' => $data['engine_type'],
            'transmission' => $data['transmission'],
            'fuel_type' => $data['fuel_type'],
            'price' => $data['price'],
            'description' => $data['description'],
            'quest_cost' => $data['quest_cost'],
            'quest_commission' => $data['quest_commission'],
        ]);

        return redirect()->route('admin.quest.list')->with('success', 'Quest created successfully.');
    }
}
