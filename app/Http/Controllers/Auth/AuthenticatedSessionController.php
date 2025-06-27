<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Mail\LoginNotification;
use App\Http\Controllers\Controller;
use App\Services\GeoLocationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;


class AuthenticatedSessionController extends Controller
{

    protected $geoLocationService;

    public function __construct(GeoLocationService $geoLocationService)
    {
        $this->geoLocationService = $geoLocationService;
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->validate([
            'email' => 'email',
            'g-recaptcha-response' => 'recaptcha'
        ]);



        $request->authenticate();

        $request->session()->regenerate();


        try {
            $ipAddress = $request->ip();
            $locationData = $this->geoLocationService->getLocation($ipAddress);

            $city = $locationData['city'] ?? 'Unknown';
            $country = $locationData['country'] ?? 'Unknown';

            // Auth::login($authUser);

            $name = Auth()->user()->name;
            // $name = $reques\\\\t->name;

            Mail::to($request->email)->send(new LoginNotification($name, $ipAddress, $city, $country));

            // dd('co');

        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Our system is experiencing an error please try again later :( ');

        }



        return redirect()->route('dashboard')->with(['success' => 'Welcome Back!']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function deleteProfile(Request $request) {
        $data = $request->validate([
            'password' => 'string|required'
        ]);
    }
}
