<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});

Route::controller(LoginController::class)->group(function() {
    Route::get("/login", "Login");
    Route::get("/logout", "Logout");
});
