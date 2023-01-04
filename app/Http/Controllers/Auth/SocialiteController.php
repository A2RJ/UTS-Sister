<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProvideCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $user = User::where('email', $user->getEmail())->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('home');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Your email is not registered');
        }
    }
}
