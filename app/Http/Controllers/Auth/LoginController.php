<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Matching\ValidatorInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $maxAttempts = 3;
    protected $decayMinutes = 1;
    public function __construct()
    {
        $this->middleware('guest:web,customer')->except('logout');
    }

    protected function guard($guard = null)
    {
        return Auth::guard($guard);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            recaptchaFieldName() => recaptchaRuleName()
        ], [
            recaptchaRuleName() => 'Please ensure that you are a human!'
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        // Track login attempts using RateLimiter
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), $this->maxAttempts)) {
            // Notify the user about the lockout or implement your logic
            return $this->sendLockoutResponse($request);
        }

        $this->validateLogin($request);

        $customerAttempt = $this->guard('customer')->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );

        if (!$customerAttempt) {
            $adminAttempt = $this->guard()->attempt(
                $this->credentials($request),
                $request->filled('remember')
            );

            if (!$adminAttempt) {
                // Increment login attempts for the current key
                RateLimiter::hit($this->throttleKey($request));

                return $adminAttempt;
            }
            $this->redirectTo = '/admin';
            // Reset the login attempts when successful login
            RateLimiter::clear($this->throttleKey($request));

            return $adminAttempt;
        }

        // Reset the login attempts when successful login
        RateLimiter::clear($this->throttleKey($request));

        return redirect('/home')->with("info", "Login Successful");
    }

    // Function to get the throttle key
    protected function throttleKey(Request $request)
    {
        return $request->input('email') . '|' . $request->ip();
    }

    // Override sendLockoutResponse to include countdown
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        $minutes = floor($seconds / 60);
        $seconds = $seconds % 60;

        $formattedTime = sprintf('%02d:%02d', $minutes, $seconds);

        // Pass the formatted time to JavaScript
        return redirect('/login')->with('error', 'Too many login attempts. Please try again in ' . $formattedTime . '.')
            ->with('lockoutSeconds', $seconds);
    }
    public function showLoginForm()
    {
        return view('login');
    }
}
