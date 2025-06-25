<?php

namespace App\Orchid\Screens;

use App\Models\Quest;
use Orchid\Screen\Screen;
use Illuminate\Support\Str;
use Orchid\Attachment\File;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Illuminate\Http\UploadedFile;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;

class CreateQuestScreen extends Screen
{
    public function query(): iterable
    {
        return [];
    }

    public function name(): ?string
    {
        return 'Create Quest Screen';
    }

    public function description(): ?string
    {
        return 'Create engageable car quest posts.';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Manage Quests')->route('admin.quest.list'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('make')
                    ->title('Make')
                    ->placeholder('Enter the car make')
                    ->required(),

                \Orchid\Screen\Fields\Upload::make('image') // Use Upload field
                    ->title('Upload Images')
                    ->multiple()
                    ->acceptedFiles('image/*')
                    ->help('Upload multiple images.')
                    ->required(),

                Input::make('model')
                    ->title('Model')
                    ->placeholder('Enter the car model')
                    ->required(),

                Input::make('year')
                    ->title('Year')
                    ->placeholder('Enter the car year')
                    ->required(),

                Input::make('color')
                    ->title('Color')
                    ->placeholder('Enter the car color')
                    ->required(),

                Input::make('vin')
                    ->title('VIN')
                    ->placeholder('Enter the VIN')
                    ->required(),

                Input::make('mileage')
                    ->title('Mileage')
                    ->placeholder('Enter the mileage')
                    ->required(),

                Input::make('engine_type')
                    ->title('Engine Type')
                    ->placeholder('Enter the engine type')
                    ->required(),

                Input::make('transmission')
                    ->title('Transmission')
                    ->placeholder('Enter the transmission type')
                    ->required(),

                Input::make('fuel_type')
                    ->title('Fuel Type')
                    ->placeholder('Enter the fuel type')
                    ->required(),

                Input::make('price')
                    ->title('Price')
                    ->placeholder('Enter the price')
                    ->required(),

                TextArea::make('description')
                    ->title('Description')
                    ->placeholder('Enter a brief description')
                    ->required(),

                Button::make('Submit')
                    ->method('create'),
            ]),
        ];
    }

    public function create(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'image' => 'required|array',
            // 'image.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
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
            'description' => 'required|string',
        ]);

        $imageNames = [];



        try {
            foreach ($data['image'] as $image) {
                // Create an UploadedFile instance from the uploaded image
                $uploadedFile = new UploadedFile($image->getPathname(), $image->getClientOriginalName());

                // Use the File class to manage attachments
                $attachment = (new File($uploadedFile))->load();

                // Generate dynamic file name
                $fileName = strtolower($data['make']) . '_' . strtolower($data['model']) . '_' . Str::random(4) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

                // Store the image in the quest folder
                Storage::disk('public')->put('/quests/' . $fileName, file_get_contents($uploadedFile->getRealPath()));
                $imageNames[] = $fileName; // Collect the generated names
            }

            dd($imageNames);

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
            ]);

            Toast::info('Quest created successfully.');
        } catch (\Exception $e) {
            Toast::error('An error occurred while creating the quest: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Unable to create quest.']);
        }

        return redirect()->route('admin.quest.list');
    }
}
