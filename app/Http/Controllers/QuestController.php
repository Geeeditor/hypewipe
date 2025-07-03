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
            'vmv' => 'required|numeric',
            'task_cost' => 'required|numeric',
            'task_reward' => 'required|numeric',
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
            'vmv' => $data['vmv'],
            'description' => $data['description'],
            'task_cost' => $data['task_cost'],
            'task_reward' => $data['task_reward'],
        ]);

        return redirect()->route('admin.quest.list')->with('success', 'Quest created successfully.');
    }

    public function edit(Quest $task, $id){
        $task = Quest::find($id);

        if($task){
            return view('auth.edit-quest', ['task' => $task]);
        } else {
            return abort(403, 'Task not found');
        }
    }


    public function update(Request $request, $id) {
        $data = $request->validate([
            'image' => 'nullable|array',
            'image.*' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
            'make' => 'nullable|string',
            'model' => 'nullable|string',
            'year' => 'nullable|string',
            'color' => 'nullable|string',
            'vin' => 'nullable|string',
            'mileage' => 'nullable|numeric',
            'engine_type' => 'nullable|string',
            'transmission' => 'nullable|string',
            'fuel_type' => 'nullable|string',
            'vmv' => 'nullable|numeric',
            'task_cost' => 'nullable|numeric',
            'task_reward' => 'nullable|numeric',
            'description' => 'nullable|string',
            'deleted_image' => ['array', 'nullable'],
        ]);


        $task = Quest::findOrFail($id);



        $imageUpload = isset($data['image']) ? $data['image'] : null;


        // Handle image deletion
        if ($request->has('deleted_image') && $imageUpload !== null) {
            $deletedImage = $request->input('deleted_image');
            $databaseImage = json_decode($task->image);

            $newImage[] = $data['image'];

            foreach($request->file('image') as $image) {
                $fileName = strtolower($data['make']) . '_' . strtolower($data['model']) . '_' . Str::random(4) . '_' . time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->put('/quests/' . $fileName, file_get_contents($image));
                $images[] = $fileName;
            }

            $imageDifference = array_diff($databaseImage,$deletedImage);

            $updatedImageData = array_merge($imageDifference, $images);

            $taskData = [
                'make' => $request->input('make') ? $data['make'] : $task->make,
                'model' => $request->input('model') ? $data['model'] : $task->model,
                'year' => $request->input('year') ? $data['year'] : $task->year,
                'color' => $request->input('color') ? $data['color'] : $task->color,
                'vin' => $request->input('vin') ? $data['vin'] : $task->vin,
                'mileage' => $request->input('mileage') ? $data['mileage'] : $task->mileage,
                'mileage' => $request->input('mileage') ? $data['mileage'] : $task->mileage,
                'engine_type' => $request->input('engine_type') ? $data['engine_type'] : $task->engine_type,
                'transmission' => $request->input('transmission') ? $data['transmission'] : $task->transmission,
                // 'user_id' => $admin->,
                'fuel_type' => $data['fuel_type'] ? $data['fuel_type'] : $task->fuel_type,
                'vmv' => $data['vmv'] ? $data['vmv'] : $task->vmv,
                'description' => $data['description'] ? $data['description'] : $task->description,
                'task_cost' => $data['task_cost'] ? $data['task_cost'] : $task->task_cost,
                'task_reward' => $data['task_reward'] ? $data['task_reward'] : $task->task_reward,
                'image' => json_encode($updatedImageData)

            ];

            $task->update($taskData);

            // dd('Database update success');
            return redirect()->back()->with('success', 'Task has been updated successfully');

            }

            elseif (!$request->has('deleted_image') && $imageUpload !== null) {
            // $newImage[] = $data['image'];

            // foreach($request->file('images') as $image) {
            //     $fileName = 'shortlet_' .  Str::random(4) . substr(time(), 6, 8) . $image->getClientOriginalExtension();
            //     Storage::disk('public')->put('/shortlet/' . $fileName, file_get_contents($image));
            //     $images[] = $fileName;
            // }

            // $shortletData = [
            //     'address' => $request->input('address') ? $data['address'] : $shortlet->address,
            //     'apartment_title' => $request->input('apartment_title') ? $data['apartment_title'] : $shortlet->apartment_title,
            //     'description' => $request->input('description') ? $data['description'] : $shortlet->description,
            //     'bedrooms' => $request->input('bedrooms') ? $data['bedrooms'] : $shortlet->bedrooms,
            //     'bathrooms' => $request->input('bathrooms') ? $data['bathrooms'] : $shortlet->bathrooms,
            //     'max_guest' => $request->input('max_guest') ? $data['max_guest'] : $shortlet->max_guest,
            //     'apartment_type' => $request->input('apartment_type') ? $data['apartment_type'] : $shortlet->apartment_type,
            //     'checking_option' => $request->input('checking_option') ? $data['checking_option'] : $shortlet->checking_option,
            //     'apartment_price' => $request->input('apartment_price') ? $data['apartment_price'] : $shortlet->apartment_price,
            //     // 'user_id' => $admin->,
            //     'apartment_availability' => $data['apartment_availability'] ? $data['apartment_availability'] : $shortlet->apartment_availability,
            //     'images' => json_encode($images)

            // ];

            // $shortlet->update($shortletData);

            // dd('Database update success');
            return redirect()->back()->with('error', 'We are experiencing a system error');

        }

        elseif (!$request->has('deleted_image') && $imageUpload == null) {
            $taskData = [
                'make' => $request->input('make') ? $data['make'] : $task->make,
                'model' => $request->input('model') ? $data['model'] : $task->model,
                'year' => $request->input('year') ? $data['year'] : $task->year,
                'color' => $request->input('color') ? $data['color'] : $task->color,
                'vin' => $request->input('vin') ? $data['vin'] : $task->vin,
                'mileage' => $request->input('mileage') ? $data['mileage'] : $task->mileage,
                'mileage' => $request->input('mileage') ? $data['mileage'] : $task->mileage,
                'engine_type' => $request->input('engine_type') ? $data['engine_type'] : $task->engine_type,
                'transmission' => $request->input('transmission') ? $data['transmission'] : $task->transmission,
                // 'user_id' => $admin->,
                'fuel_type' => $data['fuel_type'] ? $data['fuel_type'] : $task->fuel_type,
                'vmv' => $data['vmv'] ? $data['vmv'] : $task->vmv,
                'description' => $data['description'] ? $data['description'] : $task->description,
                'task_cost' => $data['task_cost'] ? $data['task_cost'] : $task->task_cost,
                'task_reward' => $data['task_reward'] ? $data['task_reward'] : $task->task_reward,
                'images' => $task->images

            ];

            $task->update($taskData);

            // dd('Database update success');
            return redirect()->back()->with('success', 'Task has been updated successfully');

        }
        // elseif ($request->has('deleted_image') && $imageUpload == null) {
        //     return redirect()->back()->with('success', 'Task updated successfully');
        // }
         else {
            return redirect()->back()->with('error', 'Task update was unsuccessfull please confirm if you have permission to perform this action');
        }
    }
}
