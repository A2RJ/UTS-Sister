<?php

use App\Models\Role;
use App\Models\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\VarDumper\VarDumper;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});

Route::get("/", function () {
    $roles = [
        [
            "role" => "rektor",
            "parent_id" => "none",
            "child_id" => "r",
        ],
        [
            "role" => "wakil rektor 1",
            "parent_id" => "r",
            "child_id" => "wr1"
        ],
        [
            "role" => "wakil rektor 2",
            "parent_id" => "r",
            "child_id" => "wr2"
        ],
        [
            "role" => "wakil rektor 3",
            "parent_id" => "r",
            "child_id" => "wr3"
        ],
        [
            "role" => "wakil rektor 4",
            "parent_id" => "r",
            "child_id" => "wr4"
        ],
        [
            "role" => "direktorat akademik",
            "parent_id" => "wr1",
            "child_id" => "dir_akademik"
        ],
        [
            "role" => "direktorat sistem dan teknologi informasi",
            "parent_id" => "wr3",
            "child_id" => "dsti"
        ],
    ];

    foreach ($roles as $value) {
        Role::create($value);
    }
});

Route::get("/search", function () {
    return Role::where("role", "wakil rektor 3")->where("parent_id", "r")->get();
});
