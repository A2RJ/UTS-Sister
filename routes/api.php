<?php

use App\Http\Controllers\API\FacultyAPIController;
use App\Http\Controllers\API\LecturerAPIController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\API\MeetingAPIController;
use App\Http\Controllers\API\PresenceAPIController;
use App\Http\Controllers\API\SanctumAuthController;
use App\Http\Controllers\API\StudentAPIController;
use App\Http\Controllers\API\StudyProgramAPIController;
use App\Http\Controllers\API\SubjectAPIController;
use App\Http\Controllers\Student\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
| if error routes not supported: Accept => application/json
|
*/

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
        Route::post('/half-day', 'halfDayPresence');
        Route::post('/full-day', 'fullDayPresence');
        Route::get('/{presence}', 'show');
    });
    Route::prefix('lecture')->controller(LecturerAPIController::class)->group(function () {
        Route::get('/', 'index');
        // Route::post('/set-study-program', 'setStudyProgram');
    });
    Route::prefix('student')->controller(StudentAPIController::class)->group(function () {
        Route::get('/', 'index')->name('api.student');
        // Route::post('import', 'import')->name('api.student.import');
        // Route::post('set-password', 'setPassword')->name('api.student.set-password');
        // Route::post('validate-password', 'validasiPassword')->name('api.student.validate-password');
    });
    Route::prefix('faculty')->controller(FacultyAPIController::class)->group(function () {
        Route::get('/', 'index');
        // Route::post('/', 'store');
    });
    Route::prefix('study-program')->controller(StudyProgramAPIController::class)->group(function () {
        Route::get('/', 'index');
    });
});
