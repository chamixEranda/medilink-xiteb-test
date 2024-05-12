<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:pharmacy', ['except' => 'logout']);
    }

    public function login()
    {
        return view('pharmacy.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (auth('pharmacy')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('pharmacy.dashboard');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['Credentials does not match.']);
    }

    public function logout(Request $request)
    {
        auth()->guard('pharmacy')->logout();
        return redirect()->route('pharmacy.auth.login');
    }

}
