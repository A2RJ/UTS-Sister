<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\API\FacultyAPIController;
use App\Http\Controllers\API\LecturerAPIController;
use App\Http\Controllers\API\MeetingAPIController;
use App\Http\Controllers\API\PresenceAPIController;
use App\Http\Controllers\API\SanctumAuthController;
use App\Http\Controllers\API\StudentAPIController;
use App\Http\Controllers\API\StudyProgramAPIController;
use App\Http\Controllers\API\SubjectAPIController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\API\CoordinateController;
use App\Http\Controllers\Utils\RandomUtilsController;
use App\Models\Presence;

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
Route::prefix('/auth')
    ->controller(SanctumAuthController::class)
    ->group(function () {
        Route::post('/', 'login');
        Route::prefix('/')->middleware(['auth:sanctum,users', 'checkRole:sdm'])->group(function () {
            Route::get('/user', 'user');
            Route::post('/token', 'token')->withoutMiddleware(['auth:sanctum,users', 'checkRole:sdm']);
            Route::post('change-password', 'changePasswordSDM');
            Route::post('/admin/change-password', 'changePassword');
            Route::post('/admin/reset-password', 'resetPassword');
        });
        Route::prefix('student')->middleware(['auth:sanctum,students', 'checkRole:student'])->group(function () {
            Route::get('/', 'student');
            Route::post('/', 'studentAuth')->withoutMiddleware(['auth:sanctum,students', 'checkRole:student']);
            Route::post('change-password', 'changePasswordStudent');
        });
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
        Route::get('/total-hour', 'totalHour');
        Route::get('/is-late', 'isLate');
        Route::get('/{presence}', 'show');
        Route::post('/check-in', 'store');
        Route::post('/check-out', 'update');
    });
    Route::prefix('permission')->controller(PresenceAPIController::class)->group(function () {
        Route::get('/type', 'permissionType');
        Route::get('/me', 'myPermission');
        Route::get('/sub', 'subPermission');
        Route::post('/', 'permission');
        Route::post('/{presence}', 'confirm');
        Route::delete('/{presence}', 'delete');
    });
    Route::prefix('coord')->controller(CoordinateController::class)->group(function () {
        Route::get('/', 'index');
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

// Route::prefix('super-admin')
//     ->middleware(['auth:sanctum,users', 'admin'])
//     ->controller(SuperAdminController::class)
//     ->group(function () {
//         define('STDIN', fopen("php://stdin", "r"));
//         Route::get('migrate', 'migrate');
//         Route::get('rollback', 'rollback');
//         Route::get('seed', 'seed');
//         Route::get('ubah', [StudentAPIController::class, 'changeAllStudentId']);
//     });

// Route::prefix('utils')->group(function () {
//     Route::controller(RandomUtilsController::class)->group(function () {
//         Route::prefix('import')->group(function () {
//             Route::post('dosen', 'importDosen');
//             Route::post('tendik', 'importTendik');
//             Route::post('change-email', 'changeAllEmail');
//         });
//     });
// }); 
