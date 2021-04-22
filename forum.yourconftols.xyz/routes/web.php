<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\EmailAuthController;
use Illuminate\Support\Facades\Auth;

//* Non Auth Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route("home");
    });
});

//* Non Auth Routes
Route::prefix('/login')->group(function () {
    Route::get('/', [PageController::class, "loginPage"])->name("loginPage");
    Route::post('/email',[EmailAuthController::class, 'login']);
});
Route::prefix('/register')->group(function () {
    Route::get('/', [PageController::class, "registerPage"])->name("registerPage");
    Route::post('/email',[EmailAuthController::class, 'register']);
});

Route::get('/', [PageController::class, "index"])->name("home");
