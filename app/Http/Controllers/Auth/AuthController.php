<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Sister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function form()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Sister::authorize();
            $user = Auth::user();
            session(['id_sdm' => $user->sdm_id, 'sdm_name' => $user->sdm_name]);
            return redirect()->route('home');
        } else {
            return back()->with([
                'message' => 'Email atau password salah',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/login');
    }
}
