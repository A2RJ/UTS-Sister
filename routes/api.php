<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\API\MeetingAPIController;
use App\Http\Controllers\API\PresenceAPIController;
use App\Http\Controllers\API\SanctumAuthController;
use App\Http\Controllers\API\SubjectAPIController;
use App\Http\Controllers\Student\StudentController;
use App\Models\Student;
use Rap2hpoutre\FastExcel\FastExcel;

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

Route::get('/students', [StudentController::class, 'index']);

Route::get('/', [HomeController::class, 'api']);

Route::prefix('/auth')->controller(SanctumAuthController::class)->group(function () {
    Route::get('/user', 'user')->middleware('auth:sanctum');
    Route::post('/token', 'token');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('subject')->group(function () {
        Route::controller(SubjectAPIController::class)->group(function () {
            Route::get('/', 'bySdm');
            Route::get('/today', 'today');
            Route::get('/{subject_id}', 'show');
        });
        Route::controller(MeetingAPIController::class)->group(function () {
            Route::get('/{subject_id}/meeting', 'meeting');
            Route::post('/{subject_id}/meeting/{meeting_id}/start', 'startMeeting');
        });
    });
    Route::prefix('presence')->controller(PresenceAPIController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/today', 'today');
        Route::post('/check-in', 'store');
        Route::post('/check-out', 'update');
        Route::get('/{presence}', 'show');
    });
});


// define('STDIN', fopen("php://stdin", "r"));
// Route::get("/migrate", function () {
//     Artisan::call('migrate:fresh', [
//         '--force' => true
//     ]);
//     return response()->json([
//         'result' => "Berhasil"
//     ]);
// });
// Route::get("/rollback", function () {
//     Artisan::call('migrate:rollback', [
//         '--force' => true
//     ]);
//     return response()->json([
//         'result' => "Berhasil"
//     ]);
// });
// Route::get("/seed", function () {
//     Artisan::call('db:seed', [
//         '--force' => true
//     ]);
//     return response()->json([
//         'result' => "Berhasil"
//     ]);
// });