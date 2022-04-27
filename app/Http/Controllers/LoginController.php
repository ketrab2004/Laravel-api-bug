<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login()
    {
        // select a random users' emails
        $user = User::all("email")->random();

        $success = Auth::attempt(["email" => $user->email, "password" => "password"]);

        return back()->with("msg", $success ? "succesfully logged in" : "failed to log in");
    }

    public function Logout()
    {
        Auth::logout();

        return back()->with("msg", "succesfully logged out");
    }
}
