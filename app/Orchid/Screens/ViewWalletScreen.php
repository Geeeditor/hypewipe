<?php

namespace App\Orchid\Screens;

use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use App\Models\AdminWallets; // Import the model

use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Repository; // Import Repository

class ViewWalletScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        // Wrap wallet data in Repository instances
        $wallets = AdminWallets::all()->map(function ($wallet) {
            return new Repository($wallet->toArray());
        });

        return [
            'wallets' => $wallets,
            'metrics' => [
                'total_wallets' => AdminWallets::count(),
            ],
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Admin Wallet Management';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Manage admin wallets (note all deposit will be processed to provided wallets).';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            /* Button::make('Show toast')
                ->method('showToast')
                ->novalidate()
                ->icon('bs.chat-square-dots'),

            ModalToggle::make('Launch demo modal')
                ->modal('exampleModal')
                ->method('showToast')
                ->icon('bs.window'), */
                Link::make('Create a Wallet')
                ->route('admin.wallet')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::metrics([
                'Total Wallets' => 'metrics.total_wallets',
            ]),

            Layout::table('wallets', [
                TD::make('id', 'ID')->width('100'),
                TD::make('wallet_address', 'Wallet Address')->cantHide(),
                TD::make('wallet_name', 'Wallet Name'),
                TD::make('wallet_type', 'Wallet Type'),
                TD::make('created_at', 'Created')
                    ->usingComponent(DateTimeSplit::class),
                TD::make('actions', 'Actions')->render(function (Repository $wallet) {
                    return Link::make('Edit')
                        ->route('admin.wallet.edit',$wallet->get('id')) . ' | ' .
                        Button::make('Delete')
                            ->method('deleteWallet')
                            ->confirm('Are you sure you want to delete this wallet?')
                            ->parameters(['id' => $wallet->get('id')]);
                }),
            ]),

            Layout::modal('exampleModal', Layout::rows([
                // Add modal content as needed
            ]))->title('Create your own toast message'),
        ];
    }

    public function showToast(Request $request): void
    {
        Toast::warning($request->get('toast', 'Hello, world! This is a toast message.'));
    }

    public function deleteWallet(Request $request)
    {
        $walletId = $request->get('id');
        $wallet = AdminWallets::find($walletId);

        if ($wallet) {
            $wallet->delete();
            Toast::info('Wallet deleted successfully.');
        } else {
            Toast::error('Wallet not found.');
        }

        return redirect()->route('admin.wallet.view'); // Adjust the route name as needed
    }
}
