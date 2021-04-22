<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailAuthLoginRequest;
use App\Http\Requests\EmailAuthRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Godruoyi\Snowflake\Snowflake;

class EmailAuthController extends Controller
{

    public function login(EmailAuthLoginRequest $request)
    {
        $data = $request->all();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['message' => 'Email or Password has been enter incorrectly']);
        }
    }

    public function register(EmailAuthRegisterRequest $request)
    {
        $data               = $request->all();
        $snowflake          = new Snowflake();
        $password           = Hash::make($data['password']);
        $user               = new User();
        $user->uuid         = $snowflake->setStartTimeStamp(1420070400000)->id();
        $user->email        = $data['email'];
        $user->username     = $data['username'];
        $user->password     = $password;
        $user->save();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect()->route('home');
        }
    }
}
