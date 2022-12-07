<?php

namespace App\Http\Controllers\Admin\Sanctum;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class SanctumAuthController extends Controller
{
    // create table ability
    public function user(Request $request)
    {
        return response($request->user());
    }

    public function token(RequestToken $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $user->tokens()->delete();
        return response([
            "access_token" => $user->createToken($user->name)->plainTextToken
        ]);
    }
}
