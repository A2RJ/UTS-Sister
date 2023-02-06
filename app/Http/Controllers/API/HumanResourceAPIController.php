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
}
