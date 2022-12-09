<?php

use App\Http\Controllers\Admin\HumanResourceController;
use App\Http\Controllers\Admin\Sanctum\SanctumAuthController;
use App\Http\Controllers\Admin\UtilityController;
use App\Http\Controllers\Attendance\AttendanceSettingController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BKD\SDMController;
use App\Http\Controllers\BKD\KompetensiController;
use App\Http\Controllers\BKD\KualifikasiController;
use App\Http\Controllers\BKD\PelaksPendidikanController;
use App\Http\Controllers\BKD\PelaksPenelitian;
use App\Http\Controllers\BKD\PelaksPengabdian;
use App\Http\Controllers\BKD\PenunjangController;
use App\Http\Controllers\BKD\ProfilController;
use App\Http\Controllers\BKD\ReferensiController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [Controller::class, 'index'])->name('index');

Route::middleware("auth")->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('bkd')->group(function () {
        Route::prefix("sdm")->controller(SDMController::class)->group(function () {
            Route::get('/', 'index')->name('sdm.index');
            Route::get('set-sdm/{sdm_id}/{sdm_name}',  'setSession')->name('sdm.set-sdm');
        });

        Route::prefix('profil')->controller(ProfilController::class)->group(function () {
            Route::get("/data-pribadi", 'dataPribadi')->name('datapribadi');
            Route::prefix('inpassing')->group(function () {
                Route::get("/", 'inpassing')->name('inpassing');
                Route::get("/{id}", 'detailInpassing')->name('inpassing.detail');
                Route::get("/{id}/download", 'downloadInpassing')->name('inpassing.download');
            });
            Route::prefix('jabatan-fungsional')->group(function () {
                Route::get("/", 'jabatanFungsional')->name('jabatan-fungsional');
                Route::get("/{id}", 'detailJabatanFungsional')->name('jabatan-fungsional.detail');
                Route::prefix('ajuan')->group(function () {
                    Route::get("/", 'ajuanJabatanFungsional')->name('jabatan-fungsional.ajuan');
                    Route::get("/{id}", 'detailAjuanJabatanFungsional')->name('jabatan-fungsional.ajuan-detail');
                });
            });
            Route::prefix("kepangkatan")->group(function () {
                Route::get("/", 'kepangkatan')->name('kepangkatan');
                Route::get("/{id}", 'detailKepangkatan')->name('kepangkatan.detail');
            });
            Route::prefix("penempatan")->group(function () {
                Route::get("/", 'penempatan')->name('penempatan');
                Route::get("/{id}", 'detailPenempatan')->name('penempatan.detail');
            });
        });

        Route::prefix('kualifikasi')->controller(KualifikasiController::class)->group(function () {
            Route::prefix('pendidikan-formal')->group(function () {
                Route::get('/', 'pendidikanFormal')->name('pendidikan-formal');
                Route::get('/{id}', 'detailPendidikanFormal')->name('pendidikan-formal.detail');
                Route::prefix('ajuan')->group(function () {
                    Route::get('/', 'ajuanPendidikanFormal')->name('pendidikan-formal.ajuan');
                    Route::get('/{id}', 'detailAjuanPendidikanFormal')->name('pendidikan-formal.ajuan-detail');
                });
            });
            Route::prefix("diklat")->group(function () {
                Route::get('/', 'diklat')->name('diklat');
                Route::get('/{id}', 'detailDiklat')->name('diklat.detail');
            });
            Route::prefix("riwayat-pekerjaan")->group(function () {
                Route::get('/', 'riwayatPekerjaan')->name('riwayat-pekerjaan');
                Route::get('/{id}', 'detailRiwayatPekerjaan')->name('riwayat-pekerjaan.detail');
            });
        });

        Route::prefix('kompetensi')->controller(KompetensiController::class)->group(function () {
            Route::prefix("sertifikasi-profesi")->group(function () {
                Route::get('/', 'sertifikasiProfesi')->name('sertifikasi-profesi');
                Route::get('/{id}', 'detailSertifikasiProfesi')->name('sertifikasi-profesi.detail');
            });
            Route::get("sertifikasi-dosen/{id}", 'detailSertifikasiDosen')->name('sertifikasi-dosen.detail');
            Route::prefix("test")->group(function () {
                Route::get('/', 'tes')->name('tes');
                Route::get('/{id}', 'detailTes')->name('tes.detail');
                Route::prefix('ajuan')->group(function () {
                    Route::get('/', 'ajuanTes')->name('tes.ajuan');
                    Route::get('/{id}', 'detailAjuanTes')->name('tes.ajuan-detail');
                });
            });
        });

        Route::prefix('pelaks-pendidikan')->controller(PelaksPendidikanController::class)->group(function () {
            Route::prefix("pengajaran")->group(function () {
                Route::get('/', 'pengajaran')->name('pengajaran');
                Route::get('/{id}', 'detailPengajaran')->name('pengajaran.detail');
                Route::get('/{id}/bidang-ilmu', 'bidangIlmuPengajaran')->name('pengajaran.bidang-ilmu');
            });
            Route::prefix('bimbingan-mahasiswa')->group(function () {
                Route::get('/{id_semester?}', 'bimbinganMhs')->name('bimbingan-mahasiswa');
                Route::get('/{id}/detail', 'detailBimbinganMhs')->name('bimbingan-mahasiswa.detail');
                Route::get('/{id}/bidang-ilmu', 'bidangIlmuBimbinganMhs')->name('bimbingan-mahasiswa.bidang-ilmu');
            });
            Route::prefix('pengujian-mahasiswa')->group(function () {
                Route::get('/{id_semester?}', 'pengujianMhs')->name('pengujian-mahasiswa');
                Route::get('/{id}/detail', 'detailPengujianMhs')->name('pengujian-mahasiswa.detail');
                Route::get('/{id}/bidang-ilmu', 'bidangIlmuPengujianMhs')->name('pengujian-mahasiswa.bidang-ilmu');
            });
            Route::prefix('visiting-scientist')->group(function () {
                Route::get('/', 'vistingScientist')->name('visiting-scientist');
                Route::get('/{id}', 'detailVistingScientist')->name('visiting-scientist.detail');
            });
            // Pembinaan mahasiswa tidak ada endpoint
            Route::prefix('bahan-ajar')->group(function () {
                Route::get('/', 'bahanAjar')->name('bahan-ajar');
                Route::get('/{id}', 'detailBahanAjar')->name('bahan-ajar.detail');
            });
            Route::prefix('detasering')->group(function () {
                Route::get('/', 'detasering')->name('detasering');
                Route::get('/{id}', 'detailDetasering')->name('detasering.detail');
            });
            Route::prefix('orasi-ilmiah')->group(function () {
                Route::get('/', 'orasiIlmiah')->name('orasi-ilmiah');
                Route::get('/{id}', 'detailOrasiIlmiah')->name('orasi-ilmiah.detail');
            });
            Route::prefix('pembimbing-dosen')->group(function () {
                Route::get('/', 'pembimbingDosen')->name('pembimbing-dosen');
                Route::get('/{id}', 'detailPembimbingDosen')->name('pembimbing-dosen.detail');
            });
            Route::prefix('tugas-tambahan')->group(function () {
                Route::get('/', 'tugasTambahan')->name('tugas-tambahan');
                Route::get('/{id}', 'detailTugasTambahan')->name('tugas-tambahan.detail');
            });
        });

        Route::prefix('pelaks-penelitian')->controller(PelaksPenelitian::class)->group(function () {
            Route::prefix('penelitian')->group(function () {
                Route::get('/', 'penelitian')->name('penelitian');
                Route::get('/{id}', 'detailPenelitian')->name('penelitian.detail');
                Route::get('/{id}/bidangIlmu', 'bidangIlmuPenelitian')->name('penelitian.bidang-ilmu');
            });
            Route::prefix('publikasi-karya')->group(function () {
                Route::get('/', 'publikasiKarya')->name('publikasi-karya');
                Route::get('/{id}', 'detailPublikasiKarya')->name('publikasi-karya.detail');
                Route::get('/{id}/bidangIlmu', 'bidangIlmuPublikasiKarya')->name('publikasi-karya.bidang-ilmu');
            });
            Route::prefix('paten-hki')->group(function () {
                Route::get('/', 'patenHKI')->name('paten-hki');
                Route::get('/{id}', 'detailPatenHKI')->name('paten-hki.detail');
                Route::get('/{id}/bidangIlmu', 'bidangIlmuPatenHKI')->name('paten-hki.bidang-ilmu');
            });
        });

        Route::prefix('pelaks-pengabdian')->controller(PelaksPengabdian::class)->group(function () {
            Route::prefix('pengabdian')->group(function () {
                Route::get('/', 'pengabdian')->name('pengabdian');
                Route::get('/{id}', 'detailPengabdian')->name('pengabdian.detail');
                Route::get('/{id}/bidangIlmu', 'bidangIlmuPengabdian')->name('pengabdian.bidang-ilmu');
            });
            Route::prefix('penglola-jurnal')->group(function () {
                Route::get('/', 'pengelolaJurnal')->name('penglola-jurnal');
                Route::get('/{id}', 'detailPengelolaJurnal')->name('penglola-jurnal.detail');
            });
            Route::prefix('pembicara')->group(function () {
                Route::get('/', 'pembicara')->name('pembicara');
                Route::get('/{id}', 'detailPembicara')->name('pembicara.detail');
            });
            Route::prefix('jabatan-struktural')->group(function () {
                Route::get('/', 'jabatanStruktural')->name('jabatan-struktural');
                Route::get('/{id}', 'detailJabatanStruktural')->name('jabatan-struktural.detail');
            });
        });

        Route::prefix('penunjang')->controller(PenunjangController::class)->group(function () {
            Route::prefix('anggota-profesi')->group(function () {
                Route::get('/', 'anggotaProfesi')->name('anggota-profesi');
                Route::get('/{id}', 'detailAnggotaProfesi')->name('anggota-profesi.detail');
            });
            Route::prefix('penghargaan')->group(function () {
                Route::get('/', 'penghargaan')->name('penghargaan');
                Route::get('/{id}', 'detailPenghargaan')->name('penghargaan.detail');
            });
            Route::prefix('penunjang-lain')->group(function () {
                Route::get('/', 'penunjangLain')->name('penunjang-lain');
                Route::get('/{id}', 'detailPenunjangLain')->name('penunjang-lain.detail');
            });
        });
    });

    Route::prefix("attendance")->group(function () {
        Route::controller(AttendanceSettingController::class)->group(function () {
            Route::get("/", "index")->name("attendance.home");
        });
        Route::resource("/human_resource", HumanResourceController::class);
    });
});

// Route::prefix('admin')->group(function () {
//     Route::get('routes', [UtilityController::class, "routeList"])->middleware("dynamic");
// });
