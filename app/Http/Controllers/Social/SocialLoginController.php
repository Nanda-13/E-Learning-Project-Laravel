<?php

namespace App\Http\Controllers\Social;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    // Redirect
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    // Callback
    public function callback($provider){
        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'provider_id' => $socialUser->id ,
        ], [
            'name' => $socialUser->name ,
            'nickname' => $socialUser->nickname ,
            'email' => $socialUser->email ,
            'provider_token' => $socialUser->token ,
            'provider' => $provider ,
            'role' => 'user' ,
        ]);

        Auth::login($user);

        return to_route('user#home')->with('message', "Login Successfully");
    }
}
