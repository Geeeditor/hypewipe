<?php

namespace App\Orchid\Screens;

use App\Models\Quest;
use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Repository; // Import Repository

class QuestListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $quest = Quest::all()->map(function ($quest){
            return new Repository($quest->toArray());
        });

        return [
            'quest' => $quest,
            'metric' => [
                'total_quest' => Quest::count(),
            ]
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */

    public function name(): ?string
    {
        return 'MANGE CREATED QUEST LIST';
    }

    public function description(): ?string {
        return 'Delete, edit and create engageable car quest posts. (Note: All posts are visible on user endpoint)';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Create a Quest')
                ->route('admin.quest.create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::metrics(
                ['Total Quest' => 'metric.total_quest']
            ),

            Layout::table('quest', [
                TD::make('id', 'ID')->width('20'),
                // TD::make('image', 'Thumbnaill')
                //     ->width(100)
                //     ->render(fn (Repository $quest)=>
                //     "<img src='https://loremflickr.com/500/300?random={$quest->get('id')}'
                //               alt='sample'
                //               class='d-block rounded-1 w-100 mw-100 img-fluid'>
                //             ") ,
                TD::make('make', 'Make')->width('100px'),
                TD::make('description', 'Description')->width('200')->cantHide(),
                TD::make('model', 'Model')->width('100px'),
                TD::make('year', 'Year')->width('100px'),
                TD::make('mileage', 'Mileage'),
                TD::make('fuel_type', 'Fuel Type')->width('100px'),
                TD::make('task_cost', 'Task Cost')->width('100px'),
                TD::make('task_reward', 'Task Reward')->width('100px'),

                TD::make('actions', 'Actions')->render(
                    function (Repository $quest) {
                        return Link::make('Edit')
                            ->route('admin.quest.edit', $quest->get('id')). ' | ' .
                         Button::make('Delete')
                            ->method('deleteQuest')
                            ->confirm('Are you sure you want to delete this wallet?')
                            ->parameters(['id' => $quest->get('id')]);
                    }
                )
            ])
        ];
    }

    public function deleteQuest(Request $request)
    {
        $questId = $request->get('id');
        $quest = Quest::find($questId);
        // dd($quest);


        if ($quest) {
            $quest->delete();
            Toast::info('Quest deleted successfully.');
        } else {
            Toast::error('Quest not found.');
        }

        return redirect()->route('admin.quest.list'); // Adjust the route name as needed
    }
}
