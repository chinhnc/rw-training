<?php
/**
 * Created by PhpStorm.
 * User: nguyen_cong_chinh
 * Date: 2017/11/15
 * Time: 14:39
 */

namespace App\Factories;

use App\Models\User;
use App\Repositories\ActivationRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\Activation;

class ActivationFactory
{
    protected $activationRepo;
    protected $tokenTimeoutHour = 24;

    public function __construct(ActivationRepository $activationRepo)
    {
        $this->activationRepo = $activationRepo;
    }

    public function sendActivationMail($user)
    {
        if ($user->activated || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);
        $link = route('user.activate', $token);
        Mail::to($user)->send(new Activation($user, $link));
    }

    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);
        $user->activated = true;
        $user->save();
        $this->activationRepo->deleteActivation($token);

        return $user;
    }

    public function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivationByUser($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->tokenTimeoutHour < time();
    }
}
