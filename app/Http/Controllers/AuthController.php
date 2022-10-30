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
        $url = 'https://github.com/login/oauth/authorize';
        $parameters = [
            'client_id' => getenv('OAUTH_GITHUB_CLIENT_ID'),
            'redirect_uri' => getenv('OAUTH_GITHUB_REDIRECT_URI'),
            'scope' => 'user'
        ];
        $url .= '?' . http_build_query($parameters);

        return view('auth/form', compact('url'));
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

