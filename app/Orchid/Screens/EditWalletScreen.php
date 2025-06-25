<?php

namespace App\Orchid\Screens;

use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use App\Models\AdminWallets; // Import the model
use Orchid\Screen\Repository; // Import Repository

class EditWalletScreen extends Screen
{
    public function query(AdminWallets $adminWallet): iterable
    {
        // Wrap the wallet data in a Repository instance
        return [
            'adminWallet' => new Repository($adminWallet->toArray()),
        ];
    }

    public function name(): ?string
    {
        return 'Edit Wallet';
    }

    public function commandBar(): iterable
    {
        return [];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('adminWallet.wallet_address')
                    ->title('Wallet Address'),
                Input::make('adminWallet.wallet_name')
                    ->title('Wallet Name'),
                Input::make('adminWallet.wallet_type')
                    ->title('Wallet Type'),
                Button::make('Save')
                    ->method('saveWallet')
                    ->icon('check'),
            ]),
        ];
    }

    public function saveWallet(AdminWallets $adminWallet)
    {
        // Fill the wallet with data from the request
        $adminWallet->fill(request()->get('adminWallet'))->save();
        Alert::info('Wallet updated successfully.');

        return redirect()->route('admin.wallet.view'); // Adjust the route name as needed
    }
}
