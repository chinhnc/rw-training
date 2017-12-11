<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Factories\ActivationFactory;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

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
            return back()->with('activationWarning', '確認のメールを送信しました。メール内のURLをクリックし、登録を完了してください。');
        } else if (!$user->is_active) {
            auth()->logout();
            return back()->with('activationWarning', '申し訳ございませんが、このアカウントはブロックされました！');
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
                'password' => 'required',
                'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    protected function username()
    {
        return 'emailOrNickname';
    }

    protected function credentials(Request $request)
    {
        $field = filter_var($request->emailOrNickname, FILTER_VALIDATE_EMAIL) ? 'email' : 'nickname';
        $request->merge([$field => $request->emailOrNickname]);

        return $request->only($field, 'password');
    }
}
