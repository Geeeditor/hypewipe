<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validate the request data
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            // 'email' => 'nullable|string|email|max:255|unique:users,email,' . Auth::id(),
            'contact_no' => 'nullable|string|max:15', // Adjust max length as needed
            'gender' => 'nullable|string|in:male,female,other' // Adjust options as needed
        ]);

        $user = Auth::user();

        // Dynamically update only the fields that are present in the request
        foreach ($data as $key => $value) {
            if ($value !== null) {
                $user->$key = $value;

                // Check if the email has changed
                if ($key === 'email' && $user->isDirty('email')) {
                    $user->email_verified_at = null;
                }
            }
        }

        // Save the updated user model
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('info', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // $data = $request->validateWithBag('userDeletion', [
        //     'password' => ['required', 'current_password'],
        // ]);

        $data = $request->validate([
            'password' => 'required|string'
        ]);

        if (!Auth::guard('web')->attempt(['email' => $request->user()->email, 'password' => $data['password']])) {
            return redirect()->back()->with('info', 'Account termination unsuccessfull due to wrong password');
        }

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
