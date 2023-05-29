<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Services\EmailService;


class UserController extends Controller
{

    private $status_code    =        200;

    public function userSignUp(Request $request) {
        $validator              =        Validator::make($request->all(), [
            "name"              =>          "required",
            "email"             =>          "required|email",
            "password"          =>          "required",
            "phone"             =>          "required"
        ]);

        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "validation_error", "errors" => $validator->errors()]);
        }

       $userDataArray            =       array(
            "name"               =>          $request->name,
            "email"              =>          $request->email,
            "password"           =>          $request->password,
            "phone"              =>          $request->phone
        );

        $user_status            =           User::where("email", $request->email)->first();

        $user_phone_status      =           User::where("phone", $request->phone)->first();

        if(!is_null($user_status)) {
           return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! Email already registered"]);
        }

        if(!is_null($user_phone_status)) {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! Phone number already registered"]);
         }

        $user                   =           User::create($userDataArray);

        if(!is_null($user)) {
            return response()->json(["status" => $this->status_code, "success" => true, "message" => "Registration completed successfully", "data" => $user]);
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "failed to register"]);
        }
    }


    // ------------ [ User Login ] -------------------
    public function userLogin(Request $request) {

        $validator          =       Validator::make($request->all(),
            [
                "email"             =>          "required|email",
                "password"          =>          "required"
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
        }


        // check if entered email exists in db
        $email_status       =       User::where("email", $request->email)->first();


        // if email exists then we will check password for the same email

        if(!is_null($email_status)) {
            $user    =   User::where("email", $request->email)->first();

            // if password is correct
            if($user && Hash::check($request->password, $user->password)) {

                $user           =       $this->userDetail($request->email);
                return response()->json(["status" => $this->status_code, "success" => true, "message" => "You have logged in successfully", "data" => $user]);
            }

            else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Incorrect password."]);
            }
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Email doesn't exist."]);
        }
    }

    // ------------------ [ User Forget Password ] ---------------------

    public function userForgetOTP(Request $request) {

        $validator          =       Validator::make($request->all(),
        [
            "phone"             =>          "required",
        ]
    );

    if($validator->fails()) {
        return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
    }

    // check if entered email exists in db
    $phone_status       =       User::where("phone", $request->phone)->first();
    
    if(!is_null($phone_status)){

        $randomNumber = random_int(100000, 999999);

        User::where('phone', $request->phone)
            ->update(['otp' => $randomNumber]);
            
        $user           =       $this->userDetail($phone_status->email);

        // (new EmailService())->sendForgetPasswordMail($user);

        return response()->json(["status" => $this->status_code, "success" => true, "message" => "OTP sent Successfully", "data" => $user]);
        
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Mobile Number doesn't exist."]);
        }
    }

    public function OTPverify(Request $request) {

        $validator          =       Validator::make($request->all(),
        [
            "phone"           =>          "required",
            "otp"             =>          "required",
        ]
    );

    if($validator->fails()) {
        return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
    }

    $otp_status = User::where('phone',$request->phone)->where('otp',$request->otp)->first();

    if(!is_null($otp_status)){

       User::where('phone', $otp_status->phone)
            ->update(['otp' => null]);

       $user           =       $this->userDetail($otp_status->email);

        return response()->json(["status" => $this->status_code, "success" => true, "message" => "OTP verified Successfully", "data" => $user]);

    } else {
        return response()->json(["status" => "failed", "success" => false, "message" => "Invalid OTP !."]);
    }


    }

    




    // ------------------ [ User Detail ] ---------------------
    public function userDetail($email) {
        $user               =       array();
        if($email != "") {
            $user           =       User::where("email", $email)->first();
            return $user;
        }
    }
}
