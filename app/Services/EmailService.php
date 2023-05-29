<?php

namespace App\Services;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendForgetPasswordMail($user)
    {
        $data = ["user" => $user];

        Mail::send("emails.user_otp_mail", $data, function ($message) use (
            $user
        ) {
            $message->to($user->email)->subject("Welcome to Fan2Stage!");
        });
    }

   
}

?>
