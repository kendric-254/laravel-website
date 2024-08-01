<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;//*** */
use Illuminate\Validation\ValidationException;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function attemptLogin(Request $request)
{
    $credentials = $this->credentials($request);

    // Find the user by email
    $user = User::where('email', $credentials['email'])->first();

    // Check if the user is deactivated
    if ($user && !$user->active) {
        // Return false to prevent login
        return false;
    }

    // Attempt login with the provided credentials
    return $this->guard()->attempt(
        $credentials,
        $request->filled('remember')
    );
}
//hii itaprovide a custom message for the deactivated users
protected function sendFailedLoginResponse(Request $request)
{
    $user = User::where('email', $request->input('email'))->first();

    if ($user && !$user->active) {
        // Custom message for deactivated users
        throw ValidationException::withMessages([
            $this->username() => ['Your account is blocked from entry.']
        ]);
    }

    // Default behavior for other failed login attempts
    throw ValidationException::withMessages([
        $this->username() => [trans('auth.failed')],
    ]);
}



}
