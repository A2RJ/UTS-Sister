<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\StructureController;
use App\Http\Controllers\Admin\UtilityController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\HumanResourceController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\Admin\Sanctum\SanctumAuthController;
use App\Http\Controllers\Presence\PresenceController;
use App\Http\Controllers\Presence\MeetingController;
use App\Http\Controllers\Presence\SubjectController;

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

Route::get('/', [HomeController::class, 'api']);

Route::controller(UtilityController::class)->group(function () {
    Route::get('/routes',  'routes');
});

Route::prefix('/auth')->controller(SanctumAuthController::class)->group(function () {
    Route::get('/user', 'user')->middleware('auth:sanctum');
    Route::post('/token', 'token');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('subject')->group(function () {
        Route::controller(SubjectController::class)->group(function () {
            Route::get('/', 'byLecturerApi');
            Route::get('/today', 'today');
            Route::get('/{subject_id}', 'subjectAggregateId');
        });
        Route::controller(MeetingController::class)->group(function () {
            Route::get('/{subject_id}/meeting', 'meeting');
            Route::post('/{subject_id}/start-meeting/{meeting_id}', 'startMeeting');
            Route::post('/{subject_id}/end-meeting/{meeting_id}', 'endMeeting');
        });
    });
    Route::prefix('presence')->controller(PresenceController::class)->group(function () {
        // get list kehadiran, bisa filter perminggu/perbulan lengkap dengan total jam perhari 
        // check-in-time simpan jam masuk 
        // check-out-time simpan jam pulang
        //  
    });
});
// Route::prefix('structure')->group(function () {
//     Route::controller(StructureController::class)->group(function () {
//         Route::get('/{child_id}/role', 'role');
//         Route::get('/{child_id}/parent', 'parent');
//         Route::get('/{child_id}/all-parent', 'parents');
//         Route::get('/{child_id}/parent-flow', 'parentWFlow');
//         Route::get('/{child_id}/child', 'children');
//         Route::get('/{child_id}/all-child', 'childrens');
//         Route::get('/{child_id}/child-flow', 'childrenWFlow');
//         Route::get('/{child_id}/parent-with_children', 'parentNChildren');
//     });
// });
// Route::prefix('subdivisi')->group(function () {
//     Route::controller(HumanResourceController::class)->group(function () {
//         Route::get('/{child_id}', 'subdivisi');
//     });
//     Route::get('/with/aggregate', [PresenceController::class, 'lecturerTime']);
// });
