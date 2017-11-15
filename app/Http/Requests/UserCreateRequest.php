<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Routing\Route;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = User::where([
            ['email', $this->request->get('email')],
            ['is_active', 1],
        ])->first();

        return [
            'nickname'  => 'required|unique:users' . (!$user ? '' : ',nickname,' . $user->id),
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users' . (!$user ? '' : ',email,' . $user->id),
            'tel'       => 'required|max:15|min:10|unique:users'. (!$user ? '' : ',tel,' . $user->id),
            'password'  => 'required|string|min:6|confirmed',
            'birthday'  => 'required',
            'gender'    => 'required',
        ];
    }
}
