<?php

use App\Http\Controllers\Admin\StructuresController;
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

// Route::middleware("auth:sanctum")->group(function () {
Route::get("/user", function (Request $request) {
    return $request->user();
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
// });
