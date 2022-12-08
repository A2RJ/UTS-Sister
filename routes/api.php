<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Sanctum\SanctumAuthController;
use App\Http\Controllers\Admin\StructuresController;
use App\Http\Controllers\Admin\UtilityController;

use App\Models\HumanResource;

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


Route::prefix("admin")->group(function () {
    Route::controller(UtilityController::class)->group(function () {
        Route::get("/routes",  "routes");
    });
});

Route::prefix("/auth")->controller(SanctumAuthController::class)->group(function () {
    Route::get('/user', "user")->middleware('auth:sanctum');
    Route::post('/token', "token");
});

Route::prefix("human_resource")->group(function () {
    Route::get("/", function () {
        return HumanResource::all();
    });
    Route::prefix("structures")->controller(StructuresController::class)->group(function () {
        Route::get("/", "index");
        Route::get("/role/{child_id}", "role");
        Route::prefix("parent")->group(function () {
            Route::get("/{child_id}", "parent");
            Route::get("/{child_id}/all", "parents");
            Route::get("/{child_id}/flow", "parentWFlow");
        });
        Route::prefix("child")->group(function () {
            Route::get("/{child_id}", "children");
            Route::get("/{child_id}/all", "childrens");
            Route::get("/{child_id}/flow", "childrenWFlow");
        });
        Route::get("/parent_with_children/{child_id}", "parentNChildren");
        Route::get("/parent_with_children/{child_id}/all", "parentNChildren");
    });
});
