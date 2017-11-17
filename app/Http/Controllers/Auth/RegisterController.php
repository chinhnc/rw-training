<?php

namespace App\Http\Controllers\Auth;


use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Factories\ActivationFactory;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $this->activationFactory = $activationFactory;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'nickname'  => $data['nickname'],
            'tel'       => $data['tel'],
            'birthday'  => $data['birthday'],
            'gender'    => $data['gender'],
        ]);
    }

    public function register(UserCreateRequest $request)
    {
        //find user to check email for exist
        $user = User::where([
            ['email', $request->email],
            ['is_active', 1],
        ])->first();

        //check email for exist
        if ($user === null) {
            // email not exist
            $user = $this->create($request->all());
        } elseif (!$user->activated && $this->activationFactory->shouldSend($user)) {
            // email exist, but not actived, token was expired
            $user->update([
                'name'      => $request->name,
                'password'  => bcrypt($request->password),
                'nickname'  => $request->nickname,
                'tel'       => $request->tel,
                'birthday'  => $request->birthday,
                'gender'    => $request->gender,
            ]);
        } elseif($user->activated) {
            // actived email
            return back()->withInput()->with('message', 'The email has already been taken.');
        } else {
            return back()->withInput()->with('message', 'The email has already been taken. Please check your email to activate account.');
        }

        $this->activationFactory->sendActivationMail($user);

        return redirect('/login')->with('activationStatus', true);
    }

    public function activateUser($token)
    {
        if ($user = $this->activationFactory->activateUser($token)) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }
        abort(404);
    }
}
