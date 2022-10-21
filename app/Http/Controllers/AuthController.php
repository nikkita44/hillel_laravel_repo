<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController
{
    public function login()
    {
        return view('auth/form');
    }

    public function handleLogin(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5']
        ]);

        if (Auth::attempt($data)){
            $user = Auth::user();
            if(Hash::needsRehash($user->password)){
                $user->password = Hash::make($data['password']);
                $user->save();
            }
            return redirect()->route('index');
        }
        return back()->withErrors([
            'email'=>'Error'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('auth.login');
    }

}

