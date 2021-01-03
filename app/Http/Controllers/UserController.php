<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['string', 'min:8', 'confirmed'],
            'confirmpass' => ['string', 'min:8', 'confirmed'],
            'fullname' => ['string', 'max:255'],
            'phone' => ['string', 'max:255'],
            'about' => ['string'],
        ]);
    }

    public function show()
    {
        return view('settings', ['user' => Auth::user()]);
    }

    protected function updatePublicInfo(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $user->fullname = $request->username;
        $user->about = $request->aboutText;
        $user->notifiable = ($request->notify == 'on') ? '1' : '0';
        $user->save();

        return redirect('/settings');
    }

    protected function updatePersonalInfo(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect('/settings');
    }
}
