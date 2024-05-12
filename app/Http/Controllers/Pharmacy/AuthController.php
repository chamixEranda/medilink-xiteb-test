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

}
