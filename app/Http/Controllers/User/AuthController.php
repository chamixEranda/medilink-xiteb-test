<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function registerUser()
    {
        return view('user.register');
    }

    public function loginUser()
    {
        return view('user.login');
    }

    public function verifySignupEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }
        
        //generate otp
        $new_otp = rand(10,100).''.date('s');
        DB::table('email_verifications')->updateOrInsert(
            ['email' => $request['email']],
            [
                'token' => $new_otp,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function registerStore(Request $request)
    {
        dd($request);
    }
}
