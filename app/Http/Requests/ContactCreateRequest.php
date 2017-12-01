<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactCreateRequest extends FormRequest
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
        return [
            'tel'       => 'required|numeric',
            'email'     => 'required|email',
            'subject'   => 'required',
            'message'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tel.numeric'       => '電話番号を確認して入力してください',
            'tel.required'      => '電話番号を入力してください',
            'email.required'    => 'メールを入力してください',
            'email.email'       => 'メールの形式でを入力してください',
            'subject.required'  => '件名を入力してください',
            'message.required'  => '問い合わせの内容を入力してください',
        ];
    }
}
