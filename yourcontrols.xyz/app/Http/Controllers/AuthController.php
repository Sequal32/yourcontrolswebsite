<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use RestCord\DiscordClient;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return Socialite::driver('discord')
        ->setScopes(['identify','email','guilds.join'])
        ->redirect();
    }

    public function loginCallback()
    {
        $userData = Socialite::driver('discord')->user();
        $user = $this->getUser($userData);
        Auth::login($user);
        // return Auth::user();
        return redirect()->route('member-area');
    }

    function getUser($userData)
    {
        if ($user = User::where("discord_id", $userData->id)->first()) {
            $user = $this->updateUser($userData, $user);
            return $user;
        }else{
            $discord = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]);
            $user = new User();
            $user->discord_id = $userData->id;
            $user->avatar = $userData->avatar;
            $user->token = $userData->token;
            $user->refreshToken = $userData->refreshToken;
            $user->expiresIn = $userData->expiresIn;
            $user->email = $userData->email;
            $user->username = $userData->nickname;
            $user->roles_JSON = json_encode($this->getUserRoles($user));
            $user->save();
            $discord->guild->addGuildMember([
                "guild.id" => 764805300229636107,
                "user.id" => (int) $userData->id,
                "access_token" => $userData->token
            ]);
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
        $user->roles_JSON = json_encode($this->getUserRoles($user));
        $user->save();
        return $user;
    }

    public function getUserRoles(User $user)
    {
        $discord = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]);

        $member = $discord->guild->getGuildMember([
            'guild.id' => 764805300229636107,
            "user.id" => (Integer) $user->discord_id
        ]);

        $roles = $discord->guild->getGuildRoles(["guild.id" => 764805300229636107]);

        usort($roles, function($a, $b) {
            if((int)$a->position == (int)$b->position) return 0;
            if((int)$a->position < (int)$b->position) return 1;
            if((int)$a->position > (int)$b->position) return -1;
        });
        
        $perms = array();
        foreach ($roles as $role) {
            foreach ($member->roles as $value) {
                if($value === $role->id) {
                    array_push($perms, $role->name);
                }
            }
        }

        return $perms;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
