<?php

namespace App\Http\Controllers;// use App\Http\Controllers\LoginsystemController;

/* Dependencies */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginsystemController extends Controller
{
    public function attemptauth(Request $request)
    {
        return view("auth");
    }

    public function authenticate(Request $request)
    {   
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
