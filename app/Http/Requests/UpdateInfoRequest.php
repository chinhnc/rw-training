<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UpdateInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->is_active;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = Auth::user();

        return [
            'nickname'  => 'required|unique:users,nickname,' . $user->id,
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'tel'       => 'required|max:15|min:10|unique:users,tel,' . $user->id,
            'birthday'  => 'required|date|before:today',
            'gender'    => 'required|in:Male,Female',
        ];
    }
}
