<?php

namespace App\Orchid\Screens;

use App\Models\User;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Orchid\Screen\Repository;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input; // Import Input
use Orchid\Platform\Notifications\DashboardMessage;

class TopupUserEdit extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(UserWallet $userWallet, $id): iterable
    {
        $userWallet = $userWallet->find($id);

        if (!$userWallet) {
            abort(404, 'User Not Found');
        }

        return [
            'wallet' => new Repository($userWallet->toArray())
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Update User Account Balances';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Create a Wallet')
            ->icon('bs.back')
            ->route('admin.users.topup')
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
            Layout::rows([
                // Access the wallet data directly from the query return
                Input::make('wallet.wallet_id')
                ->title('User Wallet ID')
                ->readonly(),

                Input::make('wallet.wallet_balance')
                ->title('Wallet balance')
                ->readonly(),

                Input::make('topup_amount')
                    ->title('Top-up Amount')
                    ->type('number')
                    ->placeholder('Enter amount to top up (e.g., 0.00)')
                    ->required()
                    ->step('0.01'),

                Button::make('Top Up Balance')
                    ->method('topup')
                    ->icon('check'),
            ]),
        ];
    }

    /**
     * Handle the top-up action.
     *
     * @param Request $request
     * @param UserWallet $userWallet
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function topup(Request $request, UserWallet $userWallet, $id): \Illuminate\Http\RedirectResponse
{
    $data = $request->validate([
        'topup_amount' => 'required|numeric|min:0.01', // Ensure it's a decimal
    ]);

    // Find the user wallet by ID
    $userWallet = $userWallet->find($id);

    if (!$userWallet) {
        abort(404, 'User Not Found');
    }

    // Retrieve the associated user
    $user = $userWallet->user; // Assuming you have a relationship defined in UserWallet model

    // Add the top-up amount to the existing wallet balance
    $userWallet->wallet_balance += $data['topup_amount'];
    $userWallet->save();

    // Notify the user about the wallet update
    if ($user) { // Ensure user is not null
        $user->notify(DashboardMessage::make()
            ->title('You just received a credit!')
            ->message('Your wallet balance was updated with ' . number_format($data['topup_amount'], 2))
            ->type(Color::INFO)
        );
    }

    Toast::info('Wallet balance updated successfully.');

    return redirect()->route('admin.users.topup'); // Adjust the redirect as necessary
}
}
