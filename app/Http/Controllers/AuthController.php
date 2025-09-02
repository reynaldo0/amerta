<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $vld = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // use password_confirmation field
        ]);

        if ($vld->fails()) {
            return redirect()->back()
                ->withErrors($vld)
                ->withInput();
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
            'status'   => 'active',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Registration successful! Welcome, ' . $user->name);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $vld = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($vld->fails()) {
            return redirect()->back()
                ->withErrors($vld)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect()->back()
                ->withErrors(['email' => 'Invalid credentials.'])
                ->withInput();
        }

        return redirect()->route('dashboard')
            ->with('success', 'Login successful!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Logged out successfully!');
    }
}
