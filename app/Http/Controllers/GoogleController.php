<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    // Google login page redirect
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google se data receive hoga
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Sirf gmail.com allow karna ho to
            if (!str_ends_with($googleUser->getEmail(), '@gmail.com')) {
                return redirect()->route('users.create')->with('error', 'Only Gmail accounts are allowed.');
            }

            // Agar user pehle se exist karta hai to usko login kar do, warna naya banao
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt(str()->random(16)), // Random password
                ]
            );

             return redirect()->back()->route('users.create')->with('success', 'Registered Successful');

            
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong, please try again.');
        }
    }
}
