<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function userlogin(Request $request){
    //         $validateuser = Validator::make($request->all(),
    //         [
    //                 'email' => 'required|email',
    //                 'password' => 'required',
    //         ]);

    //         if($validateuser->fails()){
    //             return redirect()
    //             ->back()
    //             ->withErrors($validateuser);
    //         }



    //         if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){
    //             $authuser = Auth::user();
    //             return redirect()->route('home')
    //              ->with('authuser', $authuser)
    //              ->with('success', 'Login Successful');
    //         }else{
    //             return redirect()
    //         ->back()
    //         ->withErrors([
    //             'success' => 'Invalid Email or Password',])
    //         ->withInput();
    //         }
    // }




    

     public function userlogin(Request $request)
    {
        // 1. Validation
        $validateuser = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validateuser->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => $validateuser->errors()->first()
            ]);
        }

        // 2. Attempt login
        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $authuser = Auth::user();

            return response()->json([
                'status'  => 'success',
                'message' => 'Login successful',
                'user'    => $authuser
            ]);
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid Email or Password'
            ]);
        }
    }

public function userlogout()
    {
        Auth::logout(); // Laravel ka built-in logout
        // Sirf specific keys remove karna
        session()->forget(['id', 'name']);
        
        return redirect('/'); // Redirect to login page
    }



    
        public function login(Request $request){
            $validateAdmin = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required',
                ]);


          if ($validateAdmin->fails()) {
        return redirect()->back()
                         ->withErrors($validateAdmin)
                         ->withInput(); // <-- keeps old input values
        }
        
        if(Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('dashboard')->with('success', 'Login Successful');
        } else {
            return redirect()
            ->back()
            ->withErrors([
                'email' => 'Invalid Email',
                'password' => 'Invalid password'])
            ->withInput();
        }
    }
    
    
    
    public function logout(){
        Auth::guard('admins')->logout();
         return view('admin.login');


    }


}
