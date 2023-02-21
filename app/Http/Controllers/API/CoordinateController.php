<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coordinate;
use Illuminate\Http\Request;

class CoordinateController extends Controller
{
    public function index()
    {
        return $this->responseData(
            Coordinate::select('latitude', 'longitude')
                ->get()
        );
    }
}
