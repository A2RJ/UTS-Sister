<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BKD\SDMController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Sister;
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
            if (!$user) throw new Exception('Your email is not registered', 422);
            Auth::login($user);
            Sister::authorize();
            session(['id_sdm' => $user->sdm_id, 'sdm_name' => $user->sdm_name]);
            return redirect()->route('home');
        } catch (Exception $th) {
            return redirect()->route('index')->with('message', $th->getMessage());
        }
    }
}
