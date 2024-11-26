<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

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

    public function showForgotPasswordForm()
    {
        return view('pages.auth.forgotpassword');
    }

    public function handleForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $response = Password::sendResetLink(
            $request->only('email')
        );
        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('status', 'Password reset link sent!');
        }
        return back()->withErrors(['email' => 'Unable to send reset link. Please try again.']);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));
        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', 'We have emailed your password reset link!');
        }
        return back()->withErrors(['email' => 'We couldn\'t find a user with that email address.']);
    }

    public function showResetPasswordForm($token)
    {
        return view('pages.auth.resetpassword', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);
        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->forceFill([
                'password' => bcrypt($password),
            ])->save();
        });
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('v1.login')->with('status', 'Your password has been reset!');
        }
        return back()->withErrors(['email' => 'The password reset link is invalid or has expired.']);
    }
}
