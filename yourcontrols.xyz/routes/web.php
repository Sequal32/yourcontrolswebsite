<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MemberAreaController;
use App\Http\Controllers\MemberAreaBugsController;
use App\Http\Controllers\MemberAreaSuggestionsController;
use App\Http\Controllers\AuthController;

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
Route::get('/', [PageController::class, "index"])->name("home");
Route::get('/change-log', [PageController::class, "changelog"]);
Route::get('/download', [PageController::class, "download"]);


Route::prefix("/auth")->group(function() {
  Route::get('/login', [AuthController::class, "login"])->name('login');
  Route::get('/login/callback', [AuthController::class, "loginCallback"]);
  Route::get('/logout', [AuthController::class, "logout"]);
});

Route::middleware(["auth"])->prefix('/member-area')->group(function () {
  Route::prefix('/bugs')->group(function () {
    Route::redirect('/', '/member-area/bugs/submit', 301);
    Route::get('/submit',[MemberAreaBugsController::class, "get_submit"])->name("member-area/bugs/submit");
    Route::post('/submit',[MemberAreaBugsController::class, "post_submit"]);
    Route::get('/view', [MemberAreaBugsController::class, "view"])->name('member-area/bugs/view');
  });
  Route::prefix('/suggestions')->group(function () {
    Route::get('/view', [MemberAreaSuggestionsController::class, "view"])->name("member-area/suggestions/view");
    Route::redirect('/', '/member-area/suggestions/view', 301);
    Route::get('/submit', [MemberAreaSuggestionsController::class, "get_submit"])->name("member-area/suggestions/submit");
    Route::post('/submit', [MemberAreaSuggestionsController::class, "post_submit"]);
  });
  Route::get('/', [MemberAreaController::class, 'index'])->name("member-area");
});
