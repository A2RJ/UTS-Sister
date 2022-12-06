<?php

use App\Http\Controllers\Admin\RolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix("roles")->controller(RolesController::class)->group(function () {
    Route::get("/", "index");
    Route::get("/get_role/{child_id}", "getRole");
    Route::get("/get_parent/{parent_id}", "getParent");
    Route::get("/get_child/{child_id}", "getChildren");
    Route::get("/get_childs/{child_id}", "getChildrens");
    Route::get("/parent_n_children/{child_id}", "parentNChildren");
});
