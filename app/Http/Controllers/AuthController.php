<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function Register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create($validated);

        Auth::login($user);
        
        return redirect()->route('welcome');
    }

    public function Login()
    {

    }


}
