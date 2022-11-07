<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FaceBookController extends Controller
{
    /**
     * Login Using Facebook
     */
    use \App\Http\Controllers\SocialNamesTrait;
    public function loginUsingFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->stateless()->user();

            $name = $this->getName($user->getName());
            $email = $this->getEmail($user->getEmail());

            $saveUser = User::updateOrCreate([
                'facebook_id' => $user->getId(),
            ],[
//                'name' => $user->getName(),
//                'email' => $user->getEmail(),
//                'password' => Hash::make($user->getName().'@'.$user->getId())
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($name.'@'.$email)
            ]);

            Auth::loginUsingId($saveUser->id);

            return redirect()->route('home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

