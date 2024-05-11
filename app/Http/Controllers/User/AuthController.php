<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;
use App\Http\CentralLogics\Helpers;
use Illuminate\Support\Facades\Auth;

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
                'errors' => Helpers::error_processor($validator)
            ],400);
        }
        
        //generate otp
        $token = Helpers::generate_email_otp();

        //check if already exists data for this email

        $otpData = EmailVerification::where('email', $request['email'])->first();

        if ($otpData) {
            DB::table('email_verifications')
                ->where('email', $request['email'])
                ->update(['token' => $token]);
        } else {
            DB::table('email_verifications')->insert([
                'email' => $request['email'],
                'token' => $token,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Mail::to($request['email'])->queue(new EmailVerificationMail($token));

        return response()->json([
            'message' => 'We have sent the OTP to your email',
        ],200);
    }

    public function verifySignupEmailOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_verifying' => 'required',
            'digit_1' => 'required',
            'digit_2' => 'required',
            'digit_3' => 'required',
            'digit_4' => 'required',
        ],[
            'email_verifying.required' => 'Email is required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => Helpers::error_processor($validator)
            ],400);
        }

        $data = $request->all();
        $otp = $data['digit_1'] . $data['digit_2'] . $data['digit_3'] . $data['digit_4'];

        /* check otp */
        $email_verify_data = DB::table('email_verifications')->where([
            'email' => $request['email_verifying'],
            'token' => $otp,
        ])->first();

        if (isset($email_verify_data)) {
            /* delete record if otp is matched */
            DB::table('email_verifications')->where([
                'email' => $request['email_verifying'],
                'token' => $otp,
            ])->delete();

            return response()->json([
                'message' => translate('messages.email_varified_successfully'),
            ],200);
        } 
        else 
        {
            return response()->json([
                'message' => translate('messages.otp_not_matched')
            ],401);
        }
    }

    public function registerStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'contact_no' => 'required',
            'dob' => 'required',
            'address' => 'required',
        ], [
            'contact_no.required' => 'Contact no is required.',
            'dob.required' => 'Date of Birth is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => Helpers::error_processor($validator)
            ],400);
        }

        $userEmail = User::where('email', $request['email'])->first();
        if (isset($userEmail)) 
        {
            return response()->json([
                'message' => translate('messages.email_already_exist')
            ],401);
        }

        DB::beginTransaction();

        $user = User::create([
            'name' => $request->name,
            'contact' => $request->contact_no,
            'email' => $request->email,
            'dob' => $request->dob,
            'address' => $request->address,
            'email_verified_at' => now(),
        ]);

        DB::commit();

        if(Auth::loginUsingId($user->id)){
            return response()->json([
                'message' => "Registration successfull"
            ], 200);
        }
            
    }
}
