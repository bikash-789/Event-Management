<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.users.index', compact('users'));
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.show', compact('user'));
    }

    public function blacklist($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'blacklisted';
        $user->save();

        return redirect()->route('users')->with('success', 'User has been blacklisted.');
    }
    public function whitelist($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'whitelisted';
        $user->save();

        return redirect()->route('users')->with('success', 'User has been whitelisted.');
    }
    public function reactivate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return redirect()->route('users')->with('success', 'User has been reactivated.');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
}
