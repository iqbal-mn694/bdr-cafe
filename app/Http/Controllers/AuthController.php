<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function register()
    {
        return view('pages.register');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        // // return $credentials;
        return back()->withErrors([
            'error' => 'Invalid email or password'
        ])->onlyInput('email');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => ['required'],
            'email' => ['required', 'email', 'unique:'.User::class],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if($user)
        {
            return redirect()->intended('login');
        }

        return "gagalll cuyyy";
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
