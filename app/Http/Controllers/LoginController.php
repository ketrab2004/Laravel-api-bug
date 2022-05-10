<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function Login(Request $request)
    {
        // select a random users' emails
        $user = User::all("email")->random();

        $success = Auth::attempt(["email" => $user->email, "password" => "password"]);

        return back()->with("msg", $success ? "succesfully logged in" : "failed to log in");
    }

    public function Logout(Request $request)
    {
        Auth::logout();

        return back()->with("msg", "succesfully logged out");
    }
}
