<?php

namespace App\Orchid\Screens;

use App\Models\User; // Import the User model
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Layouts\Table; // Import Table layout
use Orchid\Screen\TD; // Import TD for table columns
use Orchid\Screen\Repository;
use Orchid\Screen\Actions\Link;

class TopupUser extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $users = User::all()->map(function($users){
            return new Repository (
                $users->toArray()
            );
        });
        return [
            'users' => $users, // Fetch all users
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Top-up User';
    }

    public function description(): ?string {
        return '(Add to User Balances)';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            // Layout::view('platform::partials.update-assets'),
            // Layout::view('platform::partials.welcome'),
            Layout::table('users', [
                TD::make('id', 'ID')->width('100'),
                TD::make('name', 'Name'),
                TD::make('email', 'Email'),
                // TD::make('created_at', 'Created At')->render(fn($user) => $user->created_at->format('Y-m-d H:i:s')),
                TD::make('actions', 'Actions')
                ->render(function (Repository $id){
                    return Link::make('topup')
                    ->route('admin.users.topup.edit', $id->get('id'));
                })
            ]),


        ];
    }
}
