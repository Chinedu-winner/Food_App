<?php

namespace App\Http\Controllers\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialController extends Controller{
    public function redirectToProvider(){
        return Socialite::drive('google')->redirect();
    }
    public function handleGoogleCallback(){
        try{
            $userSocial = Socialite::driver('google')->user();
            $user = User::updateOrCreate([
                'email' => $userSocial->getEmail(),
            ],
            [
                'name' => $userSocial->getName(),
                'password' => bcrypt('password'),
            ]);
            Auth::login($user, true);
            return redirect()->route('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong');
        }
    }   

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }
}
