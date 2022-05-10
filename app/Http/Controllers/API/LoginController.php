<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends BaseController
{
    public function Login(Request $request)
    {
        // select a random users' emails
        $user = User::all("email")->random();

        $success = Auth::attempt(["email" => $user->email, "password" => "password"]);

        // handle error if failed to log in
        if (!$success) return $this->handleError("failed to log in", [], 401);

        // get logged in user
        /** @var ?User $auth */ // this is a hack to get the type hinting to work (can't cast to classes in php)
        $auth = Auth::user();

        return $this->handleResponse([

            "token" => $auth->createToken("LaravelSanctumAuth")->plainTextToken,
            "user" => $auth

        ], "succesfully logged in");
    }

    public function Logout(Request $request)
    {
        Auth::logout();

        return $this->handleResponse(); // success
    }
}
