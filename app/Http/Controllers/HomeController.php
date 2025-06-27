<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use App\Models\QuestJob;
use App\Models\UserWallet;
use App\Models\UserDeposit;
use App\Models\AdminWallets;
use Illuminate\Http\Request;
use App\Models\UserWithdrawal;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\UserAvailableWallet;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification as Notification;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;


class HomeController extends Controller
{
    private function getUserPlaceholderImage()
    {
        $user = Auth::user();

        if ($user && $user->display_pic === null) {
            $usernames = $user->name; // Example input

            $displayImages = explode(" ", $usernames); // Split the string into an array

            // Select the first letter of each username
            $firstLettersArray = array_map(function ($username) {
                return strtoupper(substr($username, 0, 1)); // Get the first letter and convert to uppercase
            }, $displayImages);

            // Join the first letters into a string
            $firstLetters = implode('', $firstLettersArray);

            // Create the placeholder URL
            return 'https://placehold.co/300x300/000000/FFF?text=' . $firstLetters;
        }

        // Return a default image or null if the display picture exists
        return 'https://placehold.co/300x300/000000/FFF?text=JD'; // or a default placeholder URL
    }

    private function getUserWallet()
    {
        $user = Auth::user();
        $wallet = $user->userWallet;

        return $wallet;
    }


    private function getTaskData() {
        $user = Auth::user();
        $taskData = $user->questJob;

        return $taskData;
    }

    public function index()
    {
        $user = Auth()->user();
        $profilePic = $this->getUserPlaceholderImage();
        // dd($profilePic);
        return view('auth.dashboard', ['user' => $user, 'profilePic' => $profilePic]);
    }

    public function viewProfile()
    {
        $user = Auth()->user();
        $profilePic = $this->getUserPlaceholderImage();

        return view('auth.profile', ['user' => $user, 'profilePic' => $profilePic]);
    }

    public function quest(Quest $taskList)
    {
        $user = Auth()->user();
        $profilePic = $this->getUserPlaceholderImage();
        $wallet = $this->getUserWallet();
        $questDoneCount = $user->questJob->quest_done; // Get the quest_done value
        $totalTasks = 38; // Total tasks available

        // Fetch the next task based on quest_done value
        $nextTaskIndex = $questDoneCount; // This assumes quest_done is zero-based for indexing
        $taskList = Quest::paginate(1, ['*'], 'page', $nextTaskIndex + 1);

        // Check if there are no tasks available
        if ($questDoneCount >= $totalTasks) {
            return view('auth.quest', [
                'user' => $user,
                'taskList' => $taskList,
                'profilePic' => $profilePic,
                'message' => 'No tasks available. Come back tomorrow!',
                'taskList' => null // No tasks to show
            ]);
        }

        return view('auth.quest', [
            'user' => $user,
            'taskList' => $taskList,
            'profilePic' => $profilePic,
            'wallet' => $wallet,
            'taskData' => $this->getTaskData(),
            'questDoneCount' => $questDoneCount
        ]);
    }

    public function questStore(Request $request)
    {
        // Step 1: Validate the request data
        $data = $request->validate([
            'comment' => 'required|string|max:255',
            'quest_cost' => 'required|numeric|min:0',
            'quest_commission' => 'required|numeric|min:0|max:100'
        ]);



        // Step 2: Get the authenticated user
        $user = auth()->user();

        // Step 3: Get the user's wallet
        $userWallet = $user->userWallet ? $user->userWallet : null; // Assuming there's a relationship in User model

        // Step 4: Check if the wallet has sufficient balance
        if($userWallet == null) {
            return redirect()->back()->with('error', "Our system can't find a wallet to charge, please create one to begin enjoying your rewards.");
        }

        if ( $userWallet->wallet_balance < $data['quest_cost']) {
            return redirect()->back()->with('error', 'Insufficient balance to complete this task.');
        }

        // Step 5: Deduct the quest cost from the wallet balance
        $userWallet->wallet_balance -= $data['quest_cost'];
        $userWallet->save();

        // Step 6: Update the user's questJob model
        $questJob = $user->questJob; // Assuming there's a relationship in User model
        $questJob->quest_done += 1; // Increment quest_done by 1
        $questJob->earnings += ($data['quest_cost'] * $data['quest_commission'] / 100); // Calculate earnings
        $questJob->save();

        // Step 7: Redirect user back with a success message
        return redirect()->back()->with('success', 'Quest completed successfully!');
    }

    public function userNotification()
    {
        $user = Auth()->user();
        $profilePic = $this->getUserPlaceholderImage();
        $wallet = $this->getUserWallet();
        $userWalletID = $wallet ? $wallet->wallet_id : null;
        $adminWallets = AdminWallets::all();
        // $userDeposits = UserDeposit::all();
        $userDeposits = $user->userDeposits()->orderBy('updated_at', 'desc')->get();
        $withdrawals = $user->userWithdrawals()->orderBy('updated_at', 'desc')->get();
        $notifications = DB::table('notifications')->where('notifiable_id', $user->id)->get();
        $notificationData = [];

        foreach ($notifications as $notification) {
            // Decode the entire 'data' field, which is a JSON string
            $data = json_decode($notification->data, true); // No need for ['title'] here

            if (isset($data['title'])) {
                $notificationData[] = $data['title'];
            }
        }

        // dd($notificationData);

        $userAvailableWallets = collect();

        if ($wallet) {
            // Retrieve the userAvailableWallet data
            $userAvailableWallets = UserAvailableWallet::where('user_wallet_id', $userWalletID)->paginate(1);
        }

        return view('auth.notification', [
            'user' => $user,
            'profilePic' => $profilePic,
            'userWallet' => $wallet,
            'userAvailableWallets' => $userAvailableWallets,
            'adminWallets' => $adminWallets,
            'userDeposits' => $userDeposits,
            'withdrawals' => $withdrawals,
            'notificationData' => $notificationData
        ]);
    }



    public function viewWallet()
    {
        $user = Auth::user();
        $profilePic = $this->getUserPlaceholderImage();
        $wallet = $this->getUserWallet();
        $userWalletID = $wallet ? $wallet->wallet_id : null;
        $adminWallets = AdminWallets::all();
        $taskData = $this->getTaskData();
        // dd($taskData);
        // $userDeposits = UserDeposit::all();
        $userDeposits = $user->userDeposits()->orderBy('updated_at', 'desc')->get();
        $withdrawals = $user->userWithdrawals()->orderBy('updated_at', 'desc')->get();

        // Initialize the variable as a collection
        $userAvailableWallets = collect();

        if ($wallet) {
            // Retrieve the userAvailableWallet data
            $userAvailableWallets = UserAvailableWallet::where('user_wallet_id', $userWalletID)->paginate(1);
        }

        return view(
            'auth.wallet',
            [
                'user' => $user,
                'profilePic' => $profilePic,
                'userWallet' => $wallet,
                'userAvailableWallets' => $userAvailableWallets,
                'adminWallets' => $adminWallets,
                'userDeposits' => $userDeposits,
                'withdrawals' => $withdrawals,
                'taskData' => $taskData
            ]
        );
    }

    public function topUp(AdminWallets $adminWallets, UserDeposit $userDeposits){
        $user = Auth::user();
        $profilePic = $this->getUserPlaceholderImage();
        $wallet = $this->getUserWallet();
        $userWalletID = $wallet ? $wallet->wallet_id : null;
        $adminWallets = AdminWallets::all();
        // $userDeposits = UserDeposit::all();
        $userDeposits = $user->userDeposits()->orderBy('updated_at', 'desc')->get();
        $withdrawals = $user->userWithdrawals()->orderBy('updated_at', 'desc')->get();





        // dd($withdrawals);
        // dd($adminWallets);

        // $qrCodes = [];

        // foreach ($adminWallets as $wallet) {
        //     $text = $wallet['wallet_address']; // The text to encode
        //     $imagePath = public_path("qrcodes/{$wallet['id']}_qrcode.png"); // Define a unique path for each QR code

        //     // Generate the QR code
        //     QrCode::size(300)
        //           ->format('png')
        //           ->generate($text, $imagePath);

        //     // Store the image path for display
        //     $qrCodes[] = asset("qrcodes/{$wallet['id']}_qrcode.png");
        // }

        // dd($qrCodes);


        // Initialize the variable as a collection
        $userAvailableWallets = collect();

        if ($wallet) {
            // Retrieve the userAvailableWallet data
            $userAvailableWallets = UserAvailableWallet::where('user_wallet_id', $userWalletID)->paginate(1);
        }

        return view(
            'auth.topup',
            [
                'user' => $user,
                'profilePic' => $profilePic,
                'userWallet' => $wallet,
                'userAvailableWallets' => $userAvailableWallets,
                'adminWallets' => $adminWallets,
                'userDeposits' => $userDeposits,
                'withdrawals' => $withdrawals
            ]
        );
    }

    public function topUpStore(Request $request, AdminWallets $adminWallets) {
        // Get the currently authenticated user
        $user = auth()->user();

        // Validate incoming request data
        $data = $request->validate([
            'wallet_name' => 'required',
            'deposit_amount' => 'required|numeric',
            'wallet_address' => 'required',
            'transaction_hash' => 'required'
        ]);

        // Create a new UserDeposit instance
        $deposit = new UserDeposit();
        $adminWallets = AdminWallets::where('wallet_address', $data['wallet_name'])->first();
        $deposit->users_email = $user->email; // Fetch the email from the authenticated user
        $deposit->wallet_id = $user->userWallet->wallet_id;
        $deposit->crypto_option = $adminWallets->wallet_name;
        $deposit->deposit_amount = $data['deposit_amount'];
        $deposit->transaction_hash = $data['transaction_hash']; // Initial status

        // Save the deposit record
        $deposit->save();



        // Return a response indicating success
        // return response()->json(['message' => 'Deposit recorded successfully!'], 201);

        return redirect()->back()->with('info', 'Your deposit is processing');
    }

    public function withdraw(UserAvailableWallet $userAvailableWallet)
    {
        $user = Auth::user();
        $profilePic = $this->getUserPlaceholderImage();
        $wallet = $this->getUserWallet();
        $userWalletID = $wallet ? $wallet->wallet_id : null;
        $userDeposits = $user->userDeposits()->orderBy('updated_at', 'desc')->get();
        $withdrawals = $user->userWithdrawals()->orderBy('updated_at', 'desc')->get();
        $taskData = $this->getTaskData();

        // Initialize the variable as a collection
        $userAvailableWallets = collect();
        if ($wallet) {
            // Retrieve the userAvailableWallet data
            $userAvailableWallets = UserAvailableWallet::where('user_wallet_id', $userWalletID)->get(); // Use get() to execute the query
        } else {
            return redirect()->route('wallet')->with('info', "Our system can't detect any wallet, kindly add to proceed with withdrawals");
        }




        return view(
            'auth.withdraw',
            [
                'user' => $user,
                'profilePic' => $profilePic,
                'userWallet' => $wallet,
                'userAvailableWallets' => $userAvailableWallets,
                'userDeposits' => $userDeposits,
                'withdrawals' => $withdrawals,
                'taskData' => $taskData
            ]
        );
    }

    public function withdrawStore(Request $request, UserAvailableWallet $userAvailableWallets, QuestJob $quest){
        $user = auth()->user();


        $data = $request->validate([
            'debit_amount' => 'required',
            'wallet_address' => 'required',
            'wallet_id' => 'required',
            'wallet_pin' => 'required'
        ]);

        if($data['wallet_pin'] != $user->wallet_pin){
            return redirect()->back()->with('error', 'Wrong wallet pin provided!');
        }


        $wallet = $this->getUserWallet();

        $quest = $user->questJob;


        $withdrawal = new UserWithdrawal();
        $userAvailableWallet = UserAvailableWallet::where('wallet_address', $data['wallet_address'])->first();
        $withdrawal->users_email = $user->email;
        $withdrawal->wallet_id = $data['wallet_id'];
        $withdrawal->wallet_address = $userAvailableWallet->wallet_address;
        $withdrawal->wallet_name = $userAvailableWallet->wallet_name;
        $withdrawal->wallet_type = $userAvailableWallet->wallet_type;
        // dd($quest );
        if($data['debit_amount'] > $quest->earnings) {
            return redirect()->back()->with('error', "You don't have enough funds to cover the withdrawal amount");
        }
        $withdrawal->withdrawal_amount = $data['debit_amount'];

        $withdrawal->save();
        return redirect()->back()->with('info', 'Your withdrawal is processing');

        // dd($data);
    }

    public function destroyWallet(Request $request, $walletAddress){
        $wallet = $this->getUserWallet();
        $user = Auth::user();
        $userWalletID = $wallet ? $wallet->wallet_id : null;
        if ($userWalletID) {
            $user = User::find($userWalletID);
            $userWalletID = $userWalletID ? $userWalletID :
            $user->wallet_id;
            $user->delete();
        } else {
            return redirect()->route('')->with('info',"You can perform this action at the moment");
        }
    }

}
