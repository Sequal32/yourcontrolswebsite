<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberAreaSuggestionsController;
use App\Http\Controllers\MemberAreaBugsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/paginated/suggestions',[MemberAreaSuggestionsController::class, "api_paginated_view"]);
Route::get('/paginated/bugs',[MemberAreaBugsController::class, "api_paginated_view"]);