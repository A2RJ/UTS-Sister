<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordSDM;
use App\Models\HumanResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HumanResourceAPIController extends Controller
{
    public function index()
    {
        return $this->responseData(HumanResource::paginate());
    }

    public function changePasswordSDM(ChangePasswordSDM $request)
    {
        try {
            $sdm = HumanResource::where('sdm_id', $request->sdm_id)->first();
            if (!$sdm) return response()->json([
                'message' => 'Data not found.',
            ], 404);

            $sdm->update([
                'password' => Hash::make($request->password)
            ]);
            return response()->json(true, 204);
        } catch (Exception $e) {
            return $this->responseError($e->getMessage(), 500);
        }
    }
}
