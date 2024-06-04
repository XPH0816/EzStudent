<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetted;
use App\Models\Customer;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    function forgetPassword()
    {
        return view('forget-password');
    }

    function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers',
        ]);

        $token = Str::random(length: 64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send("emails.forget-password", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->to(route('forget.password'))->with('success', "We have send an email to reset password.");
    }
    function resetPassword($token)
    {
        $passwordReset = DB::table('password_resets')->where('token', $token)->first();

        if (!$passwordReset || Carbon::parse($passwordReset->created_at)->addMinutes(1)->isPast()) {
            return redirect()->to(route('login'))->with('info', 'The password reset link has expired');
        }

        return view("new-password", compact('token'));
    }

    function resetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[0-9]/',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[@$!%*?&#]/',
                'confirmed',
            ],
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])->first();

        if (!$updatePassword) {
            return redirect()->to(route('reset.password'))->with('error', 'Invalid');
        }

        Customer::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table("password_resets")->where(["email" => $request->email])->delete();

        Mail::to($request->email)->send(new PasswordResetted);

        return redirect()->to(route("login"))->with("info", "Password reset successful.");
    }
}
