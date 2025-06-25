<?php

namespace App\Orchid\Screens;

use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use App\Models\UserDeposit;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Actions\ModalToggle;
use App\Models\AdminWallets; // Import the model
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Repository; // Import Repository

class UserDepositScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $userDeposits = UserDeposit::all()->map(function($userDeposits) {
            return new Repository($userDeposits->toArray());
        });

        // $userDeposits = User::with('userDeposits') // Ensure the relationship is loaded
        // ->get()
        // ->map(function($deposit) {
        //     return new Repository([
        //         'id' => $deposit->id,
        //         'users_email' => $deposit->users_email ?? 'N/A', // Access the user's email safely
        //         'wallet_id' => $deposit->wallet_id,
        //         'transaction_hash' => $deposit->transaction_hash,
        //         'crypto_option' => $deposit->crypto_option,
        //         'transaction_status' => $deposit->transaction_status,
        //         'deposit_amount' => $deposit->deposit_amount,
        //         'created_at' => $deposit->created_at,
        //         'updated_at' => $deposit->updated_at,
        //     ]);
        // });

        // dd($userDeposits);

        return [
            'deposits' => $userDeposits,
            'metric' => [
                'total_deposits' => UserDeposit::count(),
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
        return 'User Deposit';
    }

    public function description(): ?string
    {
        return 'Manage user deposits(verify user deposits).';
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
            Layout::metrics(
                [
                    'Total Deposits' => 'metric.total_deposits'
                ]
                 ),

            Layout::table('deposits', [
                TD::make('id', 'ID')->width('100'),
                TD::make('users_email', 'User Name')->cantHide(),
                TD::make('wallet_id', 'Wallet ID'),
                TD::make('transaction_status', 'Transaction Status'),
                TD::make('deposit_amount', 'Deposit Amount'),
                TD::make('created_at', 'Created')
                    ->usingComponent(DateTimeSplit::class),
                TD::make('updated_at', 'Update')
                    ->usingComponent(DateTimeSplit::class),
                TD::make('actions', 'Actions')->render(
                    function (Repository $deposit) {
                        return Link::make('update')
                                ->route('admin.deposit.view', $deposit->get('id'));
                    }

                )
            ])
        ];
    }
}
