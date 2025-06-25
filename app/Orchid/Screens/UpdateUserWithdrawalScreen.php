<?php

namespace App\Orchid\Screens;

use App\Models\User;
use App\Models\QuestJob;
use Orchid\Screen\Screen;
use App\Models\UserWithdrawal;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Repository; // Import Repository
use Orchid\Platform\Notifications\DashboardMessage;
use Orchid\Support\Color;

class UpdateUserWithdrawalScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(UserWithdrawal $withdrawal, $id): iterable
    {
        // Fetch the user deposit record based on the provided ID
        $userWithdrawal = $withdrawal->find($id);

        // Check if the deposit exists
        if (!$userWithdrawal) {
            // Handle the case where the deposit is not found (optional)
            abort(404, 'Withdrawal not found');
        }

        return [
            'user' => new Repository($userWithdrawal->toArray()), // Convert the deposit record to an array
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */

    public function name(): ?string
    {
        return 'Process User Withdrawal';
    }

     /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Update User Withrawal Status';
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
                    Input::make('user.wallet_address')
                        ->title('User Wallet Address')
                        ->readonly(),
                    Input::make('user.wallet_name')
                        ->title('User Wallet Name')
                        ->readonly(),
                    Input::make('user.wallet_type')
                        ->title('User Wallet Type')
                        ->readonly(),
                    Input::make('user.wallet_id')
                        ->title('User Wallet ID')
                        ->readonly(),
                    Input::make('user.withdrawal_amount')
                        ->title('User Withdrawal Amount')
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

    public function updateStatus(UserWithdrawal $userWithdrawal, QuestJob $quest) {
        // Retrieve relevant fields from the request
        $data = request()->only(['user.wallet_address','user.wallet_name','user.wallet_type','user.withdrawal_amount' ,'user.transaction_status', 'user.users_email', 'user.wallet_id', 'user.deposit_amount', 'user.id']);



        $userData = $data['user'];

        $user = User::where('email', $userData['users_email'])->first();


        // dd($userData);
        $userWithdrawal = $userWithdrawal->find($userData['id']);

        $quest = $user->questJob;

        // dd($quest);


        if($userData['transaction_status'] === 'Success' && $userData['withdrawal_amount'] < $quest->earnings ){
            $quest->earnings -= $userData['withdrawal_amount'];
            $quest->save();
        }



        // Check if the deposit exists
        if (!$userWithdrawal) {
            // Handle the case where the deposit is not found (optional)
            abort(404, 'Withdrawal not found');
        }





        // Use updateOrCreate to update the existing record
        $userWithdrawal->update(
            [
            'transaction_status' => $userData['transaction_status'],
            ]
        );



        // dd($user);

        if ($user) { // Ensure user is not null
            $user->notify(DashboardMessage::make()
                ->title('You withdrawal was successfull!')
                ->message('Yoor withdrawal of  ' . number_format($userData['withdrawal_amount'], 2))
                ->type(Color::INFO)
            );
        }

        Alert::info('Transaction Updated Successfully!');

        return redirect()->route('admin.withdrawal');
    }
}
