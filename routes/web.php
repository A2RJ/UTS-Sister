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
    return Sister::authorize();
});

Route::prefix("referensi")->group(function () {
    Route::get("/{referensi}", function ($referensi) {
        return Sister::$referensi();
    });
});

Route::prefix("profil")->group(function () {
    Route::get("/", function () {
        return Sister::dataPribadi(env("SISTER_ID_SDM"));
    });
    Route::get("inpassing", function () {
        return Sister::inpassing(env("SISTER_ID_SDM"));
    });
    Route::prefix("japung")->group(function () {
        Route::get("/", function () {
            return Sister::japung(env("SISTER_ID_SDM"));
        });
        Route::get("{id}", function ($id) {
            return Sister::detailJapung($id);
        });
        Route::get("ajuan", function () {
            return Sister::ajuanJapung(env("SISTER_ID_SDM"));
        });
        Route::get("ajuan/{id}", function ($id) {
            return Sister::detailAjuanJapung($id);
        });
    });
    Route::prefix("kepangkatan")->group(function () {
        Route::get("/", function () {
            return Sister::kepangkatan(env("SISTER_ID_SDM"));
        });
        Route::get("{id}", function ($id) {
            return Sister::detailKepangkatan($id);
        });
    });
    Route::prefix("penempatan")->group(function () {
        Route::get("/", function () {
            return Sister::penugasan(env("SISTER_ID_SDM"));
        });
        Route::get("{id}", function ($id) {
            return Sister::detailPenugasan($id);
        });
    });
});

Route::prefix("kualifikasi")->group(function () {
    Route::prefix("pendidikan_formal")->group(function () {
        Route::get("/", function () {
            return Sister::pendidikanFormal(env("SISTER_ID_SDM"));
        });
        Route::get("/{id}", function ($id) {
            return Sister::detailPendidikanFormal($id);
        });
        Route::get("/ajuan", function () {
            return Sister::ajuanPendidikanFormal(env("SISTER_ID_SDM"));
        });
        Route::get("/ajuan/{id}", function ($id) {
            return Sister::detailAjuanPendidikanFormal($id);
        });
    });
    Route::prefix("diklat")->group(function () {
        Route::get("/", function () {
            return Sister::diklat(env("SISTER_ID_SDM"));
        });
        Route::get("/{id}", function ($id) {
            return Sister::detailDiklat($id);
        });
    });
    Route::prefix("riwayat_pekerjaan")->group(function () {
        Route::get("/", function () {
            return Sister::riwayat_pekerjaan(env("SISTER_ID_SDM"));
        });
        Route::get("/{id}", function ($id) {
            return Sister::detailRiwayatPekerjaan($id);
        });
    });
});

Route::prefix("kompetensi")->group(function () {
    Route::prefix("sertifikasi")->group(function () {
        Route::get("/", function () {
            return Sister::sertifikasiProfesi((env("SISTER_ID_SDM")));
        });
        Route::get("/{id}", function ($id) {
            return Sister::detailSertifikasiProfesi($id);
        });
    });
    Route::prefix("test")->group(function () {
        Route::get("/", function () {
            return Sister::nilaiTes((env("SISTER_ID_SDM")));
        });
        Route::get("/{id}", function ($id) {
            return Sister::detailNilaiTes($id);
        });
        Route::get("/ajuan", function () {
            return Sister::ajuanNilaiTes((env("SISTER_ID_SDM")));
        });
        Route::get("/ajuan/{id}", function ($id) {
            return Sister::detailAjuanNilaiTes($id);
        });
    });
});
Route::prefix("pelaks_pendidikan")->group(function () {
    Route::prefix("pengajaran")->group(function () {
        Route::get("/", function () {
            return Sister::pendidikanFormal(env("SISTER_ID_SDM"));
        });
        Route::get("/{id}", function ($id) {
            return Sister::detailPendidikanFormal($id);
        });
        Route::get("/ajuan", function () {
            return Sister::ajuanPendidikanFormal(env("SISTER_ID_SDM"));
        });
        Route::get("/ajuan/{id}", function ($id) {
            return Sister::detailAjuanPendidikanFormal($id);
        });
    });
});
