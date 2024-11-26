<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('pages.auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if ($user) 
        {
            if ($user->status === 'blacklisted') {
                return back()->withErrors(['email' => 'Your account has been blacklisted.']);
            }
            if (Auth::attempt($credentials)) {
                return redirect()->intended('/v1');
            }
        }
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function showRegisterForm() {
        return view('pages.auth.register');
    }

    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Auth::login($user);
        return redirect('/v1');
    }

    public function logout() {
        Auth::logout();
        return redirect('/v1/login');
    }
}
