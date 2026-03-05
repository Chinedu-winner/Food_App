<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function redirectToProvider(){
        return Socialite::drive('google')->redirect();
    }
    public function handleProviderCallback($Provider){
        try{

            $user = Socialite::drive('google')->user();
        }
catch(Exception $e){
            return redirect('/login')->with('error', 'something went wrong');

            if(!$user){
                $user = User::create([
                    'name' => $userSocial->getName(),
                    'email' => $userSocial->getemail(),
                    'password' => bcrypt('password'),
                ]);
            }
        Auth::login($user, true);
        return redirect('/home');
        }
    }
}
