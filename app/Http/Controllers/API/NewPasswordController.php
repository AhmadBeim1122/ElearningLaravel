<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NewPasswordController extends Controller
{
    // public function create($token)
    // {
    //     return view('auth.reset-password', ['token' => $token]);
    // }

    public function store(Request $request)
    {
        echo 'hello';
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);


        // return $request;










        // $status = Password::reset(
        //     $request->only('email', 'password', 'password_confirmation', 'token'),
        //     function ($user, $password) {
        //         $user->forceFill([
        //             'password' => Hash::make($password),
        //             'remember_token' => Str::random(60),
        //         ])->save();
        //     }
        // );

        // return $status === Password::PASSWORD_RESET
        //             ? redirect()->route('home')->with('status', __($status))
        //             : back()->withErrors(['email' => [__($status)]]);
    }
}
