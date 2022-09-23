<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\KualifikasiController;
use App\Http\Controllers\PelaksPendidikanController;
use App\Http\Controllers\ProfilController;
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

Route::get('/', [DashboardController::class, 'index']);

Route::prefix("referensi")->group(function () {
    Route::get('/', function () {
        return "/referensi/endpoint-params";
    })->name('referensi');
    Route::get("/{referensi}", function ($referensi) {
        return Sister::$referensi();
    })->name('referensi-name');
});

Route::prefix('profil')->controller(ProfilController::class)->group(function () {
    Route::get("/data-pribadi", 'dataPribadi')->name('datapribadi');
    Route::get("/inpassing", 'inpassing')->name('inpassing');
    Route::prefix('jabatan-fungsional')->group(function () {
        Route::get("/", 'jabatanFungsional')->name('jabatan-fungsional');
        Route::get("/{id}", 'detailJabatanFungsional')->name('detail-jabatan-fungsional');
        Route::prefix('ajuan')->group(function () {
            Route::get("/", 'ajuanJabatanFungsional')->name('ajuan-jabatan-fungsional');
            Route::get("/{id}", 'detailAjuanJabatanFungsional')->name('detail-ajuan-jabatan-fungsional');
        });
    });
    Route::prefix("kepangkatan")->group(function () {
        Route::get("/", 'kepangkatan')->name('kepangkatan');
        Route::get("/{id}", 'detailKepangktan')->name('detail-kepangkatan');
    });
    Route::prefix("penempatan")->group(function () {
        Route::get("/", 'penempatan')->name('penempatan');
        Route::get("/{id}", 'detailPenempatan')->name('detail-penempatan');
    });
});

Route::prefix('kualifikasi')->controller(KualifikasiController::class)->group(function () {
    Route::prefix('pendidikan-formal')->group(function () {
        Route::get('/', 'pendidikanFormal')->name('pendidikan-formal');
        Route::get('/{id}', 'detailPendidikanFormal')->name('detail-pendidikan-formal');
        Route::prefix('ajuan')->group(function () {
            Route::get('/', 'ajuanPendidikanFormal')->name('ajuan-pendidikan-formal');
            Route::get('/{id}', 'detailAjuanPendidikanFormal')->name('detail-ajuan-pendidikan-formal');
        });
    });
    Route::prefix("diklat")->group(function () {
        Route::get('/', 'diklat')->name('diklat');
        Route::get('/{id}', 'detailDiklat')->name('detail-diklat');
    });
    Route::prefix("riwayat-pekerjaan")->group(function () {
        Route::get('/', 'riwayatPekerjaan')->name('riwayat-pekerjaan');
        Route::get('/{id}', 'detailRiwayatPekerjaan')->name('detail-riwayat-pekerjaan');
    });
});

Route::prefix('kompetensi')->controller(KompetensiController::class)->group(function () {
    Route::prefix("sertifikasi-profesi")->group(function () {
        Route::get('/', 'sertifikasiProfesi')->name('sertifikasi-profesi');
        Route::get('/{id}', 'detailSertifikasiProfesi')->name('detail-sertifikasi-profesi');
    });
    Route::prefix("test")->group(function () {
        Route::get('/', 'nilaiTest')->name('nilai-test');
        Route::get('/{id}', 'detailNilaiTest')->name('detail-nilai-test');
        Route::prefix('ajuan')->group(function () {
            Route::get('/', 'ajuanNilaiTest')->name('ajuan-nilai-test');
            Route::get('/{id}', 'detailAjuanNilaiTest')->name('detail-ajuan-nilai-test');
        });
    });
});

Route::prefix('pelaks-pendidikan')->controller(PelaksPendidikanController::class)->group(function () {
    Route::prefix("pengajaran")->group(function () {
        Route::get('/', 'pendidikanFormal')->name('pendidikan-formal');
        Route::get('/{id}', 'detailPendidikanFormal')->name('detail-pendidikan-formal');
        Route::prefix('ajuan')->group(function () {
            Route::get('/', 'ajuanPendidikanFormal')->name('ajuan-pendidikan-formal');
            Route::get('/{id}', 'detailAjuanPendidikanFormal')->name('detail-ajuan-pendidikan-formal');
        });
    });
    Route::prefix('bimbingan-mahasiswa')->group(function () {
        Route::get('/{id_semester}', 'bimbinganMhs')->name('bimbingan-mahasiswa');
        Route::get('/{id}/detail', 'detailBimbinganMhs')->name('detail-bimbingan-mahasiswa');
        Route::get('/{id}/bidang-ilmu', 'bidangIlmuBimbinganMhs')->name('bidang-ilmu-bimbingan-mahasiswa');
    });
    Route::prefix('pengujian-mahasiswa')->group(function () {
        Route::get('/{id_semester}', 'pengujianMhs')->name('pengujian-mahasiswa');
        Route::get('/{id}/detail', 'detailPengujianMhs')->name('detail-pengujian-mahasiswa');
        Route::get('/{id}/bidang-ilmu', 'bidangIlmuPengujianMhs')->name('bidang-ilmu-pengujian-mahasiswa');
    });
    Route::prefix('visiting-scientist')->group(function () {
        Route::get('/', 'vistingScientist')->name('visiting-scientist');
        Route::get('/{id}', 'detailVistingScientist')->name('detail-visiting-scientist');
    });
    // Pembinaan mahasiswa tidak ada endpoint
    Route::prefix('bahan-ajar')->group(function () {
        Route::get('/', 'bahanAjar')->name('bahan-ajar');
        Route::get('/{id}', 'detailBahanAjar')->name('detail-bahan-ajar');
    });
    Route::prefix('detasering')->group(function () {
        Route::get('/', 'detasering')->name('detasering');
        Route::get('/{id}', 'detailDetasering')->name('detail-detasering');
    });
    Route::prefix('orasi-ilmiah')->group(function () {
        Route::get('/', 'orasiIlmiah')->name('orasi-ilmiah');
        Route::get('/{id}', 'detailOrasiIlmiah')->name('detail-orasi-ilmiah');
    });
    Route::prefix('pembimbing-dosen')->group(function () {
        Route::get('/', 'pembimbingDosen')->name('pembimbing-dosen');
        Route::get('/{id}', 'detailPembimbingDosen')->name('detail-pembimbing-dosen');
    });
    Route::prefix('tugas-tambahan')->group(function () {
        Route::get('/', 'tugasTambahan')->name('tugas-tambahan');
        Route::get('/{id}', 'detailTugasTambahan')->name('detail-tugas-tambahan');
    });
});
