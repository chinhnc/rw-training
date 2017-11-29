<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Auth;

class ContactController extends Controller
{
    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        Contact::create([
            'user_id' => !$user?: $user->id, // check if user logined? insert user_id
            'tel' => $request->tel,
            'email' => $request->email,
            'subject' => $request->subject,
            'content' => $request->msg_content,
        ]);

        return "success";
    }
}
