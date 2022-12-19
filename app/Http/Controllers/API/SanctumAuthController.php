<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class SanctumAuthController extends Controller
{
    public function user(Request $request)
    {
        return response([
            'data' => [
                'sdm_name' => $request->user()->sdm_name,
                'email' => $request->user()->email,
                'nidn' => $request->user()->nidn,
                'nip' => $request->user()->nip,
                'is_lecturer' => $request->user()->isLecturer(),
            ]
        ]);
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
            'data' => ["access_token" => $user->createToken($user->sdm_name)->plainTextToken]
        ]);
    }
}
