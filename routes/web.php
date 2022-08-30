<?php

use App\Services\Sister;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sister', function () {
    return Sister::authorize();
});

Route::prefix("referensi")->group(function () {
    Route::get("/{referensi}", function ($referensi) {
        return Sister::$referensi();
    });
});
