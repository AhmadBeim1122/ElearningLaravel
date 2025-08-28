<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect()->route('password.reset', $user->email);
        }else{
            return redirect()->back()->with([
                'error' => "Email does not match"
            ]);
        }



        // Send reset link
        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );

        // // return $status;
        // return $status === Password::RESET_LINK_SENT
        //             ? back()->with(['status' => __($status)])
        //             : back()->withErrors(['email' => __($status)]);
    }


    public function resetForm($email)
    {
        $user = User::where('email', $email)->firstOrFail();
        return view('auth.reset-password', compact('user'));
    }





    public function newpassword(Request $request)
    {
          $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('password.request')->with('status', 'Password reset successful. You can now login.');
    }


}
