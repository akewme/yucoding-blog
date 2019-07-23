<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Auth;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect('/');
    }
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        else{

            $checkemail= User::where('email', $user->email)->first();
            
            if($checkemail){
                return $checkemail;
            }else{
                $data = User::create([
                    'name'     => $user->name,
                    'avatar'     => $user->avatar,
                    'username'     => time(),
                    'email'    => !empty($user->email)? $user->email : '' ,
                    'provider' => $provider,
                    'provider_id' => $user->id
                ]);
            }
            return $data;
        }
    }
}
