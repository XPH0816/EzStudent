<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminVerificationRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    //
    public function index()
    {
        $route = 'verification.resend';
        if (auth()->check()) {
            $route = 'admin.' . $route;
        }
        return view('auth.verify', ['route' => $route]);
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('home')->with('message', 'Email verified!');
    }

    public function verifyAdmin(AdminVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('adminProfile')->with('message', 'Email verified!')->with('request', "Please change your password.");
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return $request->wantsJson()
                    ? new JsonResponse([], 202)
                    : back()->with('resent', true);
    }
}
