<?php

namespace App\Orchid\Screens;

use App\Models\User;
use Orchid\Screen\Screen;
use App\Models\UserDeposit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Repository; // Import Repository

class UserViewDepositScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(UserDeposit $deposit, $id): iterable
{
    // Fetch the user deposit record based on the provided ID
    $userDeposit = $deposit->find($id);

    // Check if the deposit exists
    if (!$userDeposit) {
        // Handle the case where the deposit is not found (optional)
        abort(404, 'Deposit not found');
    }

    return [
        'user' => new Repository($userDeposit->toArray()), // Convert the deposit record to an array
    ];
}

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Update User Deposit';
    }


    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Update User Deposit Status';
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
            Layout::rows(
                [

                    Input::make('user.id')
                        ->title('ID')
                        ->readonly(),
                    Input::make('user.users_email')
                        ->title('User Registered Email')
                        ->readonly(),
                    Input::make('user.wallet_id')
                        ->title('User Wallet ID')
                        ->readonly(),
                    Input::make('user.deposit_amount')
                        ->title('User Deposit Amount')
                        ->readonly(),

                    Select::make('user.transaction_status')
                    ->title('Transaction Status')
                    ->options([
                        'Pending' => 'Pending',
                        'Success' => 'Success',
                        'Failed' => 'Failed',
                    ])
                    ->required(),
                    Button::make('Update')
                            ->method('updateStatus')



                ]
            )
        ];
    }

    public function updateStatus(UserDeposit $userDeposit) {
        // Retrieve relevant fields from the request
        $data = request()->only(['user.transaction_status', 'user.users_email', 'user.wallet_id', 'user.deposit_amount', 'user.id']);

        // Ensure you set users_email or any other required fields if creating a new record
        // $data['user.users_email'] = $userDeposit->users_email;
        // $data['user.wallet_id'] = $userDeposit->wallet_id;
        // $data['user.deposit_amount'] = $userDeposit->deposit_amount;

        $userData = $data['user'];
        $userDeposit = $userDeposit->find($userData['id']);



        // Check if the deposit exists
        if (!$userDeposit) {
            // Handle the case where the deposit is not found (optional)
            abort(404, 'Deposit not found');
        }

        // dd($userData);

         // Ensure this is provided

        // Use updateOrCreate to update the existing record
        $userDeposit->update(
            [
            'transaction_status' => $userData['transaction_status'],
            ]
        );

        Alert::info('Transaction Updated Successfully!');

        return redirect()->route('admin.deposit');
    }
}
