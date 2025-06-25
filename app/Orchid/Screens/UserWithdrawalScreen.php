<?php

namespace App\Orchid\Screens;

use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use App\Models\UserWithdrawal;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;

use App\Models\AdminWallets; // Import the model
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Repository; // Import Repository

class UserWithdrawalScreen extends Screen
{
    public function query(): iterable
    {
        $userWithdrawal = UserWithdrawal::all()->map(function($userWithdrawal) {
            return new Repository($userWithdrawal->toArray());
        });

        return [
            'withdrawal' => $userWithdrawal,
            'metric' => [
                'total_withdrawal' => UserWithdrawal::count(),
            ]
        ];
    }

    public function name(): ?string
    {
        return 'User Withdrawal';
    }

    public function description(): ?string
    {
        return 'Manage user withdrawal (verify user withdrawal).';
    }

    public function commandBar(): iterable
    {
        return [];
    }

    public function layout(): iterable
    {
        return [
            Layout::metrics(['Total Withdrawal Processed' => 'metric.total_withdrawal']),
            Layout::table('withdrawal', [
                TD::make('id', 'ID')->width('100'),
                TD::make('users_email', 'User Name')->cantHide(),
                TD::make('wallet_address', 'Wallet Address'),
                TD::make('wallet_name', 'Wallet Name'),
                TD::make('wallet_type', 'Wallet Type'),
                TD::make('withdrawal_amount', 'Withdrawal Amount'),
                TD::make('transaction_status', 'Transaction Status'),
                TD::make('created_at', 'Created')->usingComponent(DateTimeSplit::class),
                TD::make('updated_at', 'Update')->usingComponent(DateTimeSplit::class),
                TD::make('actions', 'Actions')->render(function (Repository $deposit) {
                    return Link::make('update')->route('admin.withdrawal.update', $deposit->get('id'));
                })
            ])
        ];
    }
}
