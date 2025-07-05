<?php

namespace App\Http\Controllers;

use App\Models\UserWallet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UserAvailableWallet;
use Illuminate\Support\Facades\Auth;

class UserWalletController extends Controller
{
    //


    public function addWallet(Request $request) {
        $data = $request->validate([
            'wallet_address' => ['required'],
            'wallet_name' => ['required'],
            'wallet_type' => ['required'],
            'wallet_pin' => ['required'],
        ]);

        if (Auth::user()->user_type === 'user') {
            $user = Auth::user();
            $wallet = $user->userWallet;

            if (!$wallet) {
                $walletID = 'hw/' . substr(time(), 6, 8) . Str::random(6);
                $topUp = 100.00; // Default balance

                $wallet = new UserWallet([
                    'wallet_id' => $walletID,
                    'wallet_balance' => $topUp,
                ]);

                $user->userWallet()->save($wallet);
            }

            if ($user->wallet_pin === $data['wallet_pin']) {
                $createWallet = new UserAvailableWallet([
                    'user_wallet_id' => $wallet->wallet_id,  // Set the foreign key here
                    'wallet_address' => $data['wallet_address'],
                    'wallet_name' => $data['wallet_name'],
                    'wallet_type' => $data['wallet_type'],
                ]);
                $createWallet->save(); // Save the created wallet
                return redirect()->back()->with('success', 'Wallet added successfully!');
            } else {
                return redirect()->back()->with('error', 'Invalid Wallet Pin');
            }
        }

        return redirect()->back()->with('error', 'Unauthorized access');
    }

    public function deleteAvailableWallet(Request $request, $walletAddress)
    {
        // Validate the request


        // Get the authenticated user
        $user = Auth::user();

        // Check user type
        if ($user->user_type === 'user') {
            // Find the available wallet by wallet_address
            $userAvailableWallet = UserAvailableWallet::where('wallet_address', $walletAddress)
                ->where('user_wallet_id', $user->userWallet->wallet_id) // Ensure it's the user's wallet
                ->first();

            // Check if the wallet exists
            if ($userAvailableWallet) {

                    $userAvailableWallet->delete();
                   return redirect()->to('/wallet')->with('info', "Wallet deleted successfully");

            } else {
                return redirect()->back()->with('error', 'Wallet not found');
            }
        }

        return redirect()->back()->with('error', 'Unauthorized access');
    }
}
