<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SignUpConfirmation;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function stores(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'wallet_pin' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'g-recaptcha-response' => 'recaptcha',
            'referral_token' => ['required', 'max:6'],
            'contact_no' => ['required']
        ]);

        // Retrieve the user with the referral code
        $user = User::where("referral_code", $request->referral_token)->first();

        if ($user) {
            $total_referred_users = $user->total_referred_users + 1;
            $user->update(['total_referred_users' => $total_referred_users]);

            $referral_code = Str::random(6);


            // dd($referral_code);
            // Create the new user
            $authUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'wallet_pin' => $request->wallet_pin,
                'contact_no' => $request->contact_no,
                'referral_code' => $referral_code,
                'password' => Hash::make($request->password),
            ]);





            // Trigger the event for the newly created user
            event(new Registered($authUser)); // Use $authUser here

            // Log in the newly created user
            Auth::login($authUser);

            $name = Auth()->user()->name;
            // $name = $request->name;
            try {
                            Mail::to($request->email)->send(new SignUpConfirmation($name, $referral_code));

                } catch (\Throwable $e) {
                    return redirect()->back()->with('error', 'Our system is experiencing an error please try again later :( ');

            }

            // dd('done');

            return redirect()->route('dashboard')->with(['regsuccess'=> 'Welcome to HypeWipe', 'name' => $name]);
        } else {
            return redirect()->back()->with('error', 'Invalid referral code provided!');
        }
    }

    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'wallet_pin' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'g-recaptcha-response' => 'recaptcha',
        'referral_token' => ['required', 'max:6'],
        'contact_no' => ['required']
    ]);

    // Retrieve the user with the referral code
    $referrer = User::where("referral_code", $request->referral_token)->first();

    if ($referrer) {
        $total_referred_users = $referrer->total_referred_users + 1;
        $referrer->update(['total_referred_users' => $total_referred_users]);

        $referral_code = Str::random(6);

        // Create the new user
        $authUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'wallet_pin' => $request->wallet_pin,
            'contact_no' => $request->contact_no,
            'referral_code' => $referral_code,
            'password' => Hash::make($request->password),
        ]);

        // Create a new questJob record with quest_done and earnings set to 0
        $authUser->questJob()->create([
            'quest_done' => 0,
            'earnings' => 0,
        ]);

        // Trigger the event for the newly created user
        event(new Registered($authUser));

        // Log in the newly created user
        Auth::login($authUser);

        $name = $authUser->name;

        try {
            Mail::to($request->email)->send(new SignUpConfirmation($name, $referral_code));
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Our system is experiencing an error please try again later :( ');
        }

        return redirect()->route('dashboard')->with(['regsuccess'=> 'Welcome to HypeWipe', 'name' => $name]);
    } else {
        return redirect()->back()->with('error', 'Invalid referral code provided!');
    }
}
}
