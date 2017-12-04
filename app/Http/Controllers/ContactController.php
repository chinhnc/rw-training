<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactCreateRequest;
use App\Models\Contact;
use Auth;
use Validator;

class ContactController extends Controller
{
    public function create()
    {
        return view('contacts.create');
    }

    public function store(ContactCreateRequest $request)
    {
        $user = Auth::user();
        Contact::create([
            'user_id' => $user? $user->id : null, // check if user logined? insert user_id
            'tel' => $request->tel,
            'email' => $request->email,
            'subject' => $request->subject,
            'content' => $request->message,
        ]);

        return 'success';
    }
}
