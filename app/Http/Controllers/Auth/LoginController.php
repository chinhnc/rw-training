<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Factories\ActivationFactory;
use Illuminate\Support\Facades\Auth;

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

    protected $activationFactory;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationFactory $activationFactory)
    {
        $this->middleware('guest')->except('logout');
        $this->activationFactory = $activationFactory;
    }

    public function authenticated()
    {
        $user = Auth::user();
        if (!$user->activated) {
            auth()->logout();
            return back()->with('activationWarning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        } else if (!$user->is_active) {
            auth()->logout();
            return back()->with('activationWarning', 'Your account has been blocked!');
        }

        return redirect()->intended($this->redirectPath());
    }
}
