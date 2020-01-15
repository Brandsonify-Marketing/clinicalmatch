<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\User;
class SocialController extends Controller
{
	/**
     * Redirect Socialite
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect($provider)
    {
    	return Socialite::driver($provider)->redirect();
    }
    /**
     * Callback for Handling Social Login
     *
     * @return \Illuminate\Http\Response
     */
    public function Callback($provider)
    {
        $userSocial 	=   Socialite::driver($provider)->stateless()->user();
        $users       	=   User::where(['email' => $userSocial->getEmail()])->first();
        if($users)
        {
            Auth::login($users);
            if(auth()->user()->role_id == 8)
            {
               return redirect()->route('clinicalTrialRetention.enrolled');
            }
            return redirect()->route('profile.create');
        }
        else
        {
            $user = User::create([
                'firstname'     => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'image'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $provider,
            ]);
            Auth::login($user);
            if(auth()->user()->role_id == 8)
            {
               return redirect()->route('clinicalTrialRetention.enrolled');
            }
            return redirect()->route('profile.create');
        }
    }
}
