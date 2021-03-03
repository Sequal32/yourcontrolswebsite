<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function loginCallback()
    {
        $userData = Socialite::driver('discord')->user();
        $user = $this->getUser($userData);
        Auth::login($user);
        return redirect()->route('member-area');
    }

    function getUser($userData)
    {
        if ($user = User::find((int) $userData->id)) {
            $user = $this->updateUser($userData, $user);
            return $user;
        }else{
            $user = new User();
            $user->id = (int) $userData->id;
            $user->avatar = $userData->avatar;
            $user->token = $userData->token;
            $user->refreshToken = $userData->refreshToken;
            $user->expiresIn = $userData->expiresIn;
            $user->email = $userData->email;
            $user->username = $userData->nickname;
            $user->save();
            return $user;
        }
    }

    function updateUser($userData, $user)
    {
        $user->avatar = $userData->avatar;
        $user->token = $userData->token;
        $user->refreshToken = $userData->refreshToken;
        $user->expiresIn = $userData->expiresIn;
        $user->email = $userData->email;
        $user->username = $userData->nickname;
        return $user;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
