<?php

namespace App\Orchid\Screens;

use App\Models\AdminWallets; // Import the model
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request; // Import the Request class

class CreateWalletScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Create a Wallet';
    }

    public function description(): ?string
    {
        return 'Fill out the form correctly with your valid wallet information';
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
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::block(Layout::rows([
                Input::make('wallet_name')
                    ->title('Wallet Name')
                    ->placeholder('Binance Smart Chain')
                    ->required(),

                Input::make('wallet_address')
                    ->title('Wallet Address')
                    ->placeholder('7xnxnc2313dn221dxcb....')
                    ->required(),

                Select::make('wallet_type')
                    ->title('Network')
                    ->options([
                        'btc' => 'BTC',
                        'trc20' => 'TRC20',
                        'bep20' => 'BEP20',
                        'erc20' => 'ERC20',
                        'sol' => 'SOL',
                        'bnb' => 'BNB',
                    ])
                    ->required(),

                Button::make('Submit')
                    ->method('submitForm'), // This will call the submitForm method
            ]))
            ->title('Wallet Information')
            ->description('Please enter the details of your wallet.'),
        ];
    }

    /**
     * Handle the form submission.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitForm(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'wallet_name' => 'required|string|max:255',
            'wallet_address' => 'required|string|max:255',
            'wallet_type' => 'required|string|max:20',
        ]);

        // Save the wallet data to the database
        AdminWallets::create([
            'wallet_name' => $validatedData['wallet_name'],
            'wallet_address' => $validatedData['wallet_address'],
            'wallet_type' => $validatedData['wallet_type'],
        ]);

        // Show success message
        Toast::info('Wallet created successfully.');

        // Return a redirect response
        return redirect()->route('admin.wallet.view'); // Adjust the route name as needed
    }
}
