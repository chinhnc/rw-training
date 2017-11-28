<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }

    public function update(UpdateInfoRequest $request)
    {
        Auth::user()->fill($request->all())->save();

        return back()->with('success-mess', '情報がアップデートされました');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        if (Auth::attempt(['email' => $user->email, 'password' => $request->old_password])) {
            $user->update([
                'password'  => bcrypt($request->password),
            ]);

            return back()->with('success-mess', 'パスワードがアップデートされました');
        }

        return back()->with('error-mess', '現在のパスワードを正しく入力してください！');
    }

    public function showPassbook()
    {
        $user = Auth::user();
        $actions = $user->getActionHistories()->paginate(15);

        return view('users.action_histories', compact(['actions', 'user']));
    }

    public function searchPassbookByMonth(Request $request)
    {
        if ($request->year && $request->month) {
            $user = Auth::user();
            $actions = $user->getActionHistories()
                ->whereYear('created_at', '=', $request->year)
                ->whereMonth('created_at', '=', $request->month)
                ->paginate(15);

            return view('users.action_histories', compact(['actions', 'user']));
        }

        return redirect(route('passbook'));
    }
}
