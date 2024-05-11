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
use App\Services\UserService;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

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
            'password'          => 'required|min:6|max:20',
            'confirm_password'  => 'required|min:6|max:20|same:password',
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

        $userEmail = $this->userService->getUserByEmail($request['email']);
        if (isset($userEmail)) 
        {
            return response()->json([
                'message' => translate('messages.email_already_exist')
            ],401);
        }

        DB::beginTransaction();

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['contact'] = $request->contact_no;
        $data['email_verified_at'] = now();
        $user = $this->userService->createUser($data);

        DB::commit();

        if(Auth::loginUsingId($user->id)){
            return response()->json([
                'message' => "Registration successfull"
            ], 200);
        }
            
    }

    public function loginCheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required|min:8|max:20',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => Helpers::error_processor($validator)
            ],400);
        }

        $user = $this->userService->getUserByEmail($request['email']);
        if ($user) {
            $creds = $request->only('email','password');
            if (Auth::guard('web')->attempt($creds) ) {
                return response()->json(['message' => translate('messages.you_are_logged_in')],200);

            }else {
                return response()->json(['message' => translate('messages.invalid_credentials')],401);
            }
        }else
            return response()->json(['message' => translate('messages.user_not_found')],401);
    }
}
