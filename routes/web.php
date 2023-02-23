<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\HumanResourceController;
use App\Http\Controllers\Admin\StructuralPositionController;
use App\Http\Controllers\Admin\StructureController;
use App\Http\Controllers\Akademik\ProdiController;
use App\Http\Controllers\Akademik\SemesterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Presence\PresenceController;
use App\Http\Controllers\Presence\Teaching\ClassController;
use App\Http\Controllers\Presence\Teaching\MeetingController;
use App\Http\Controllers\Presence\Teaching\SubjectController;

use App\Http\Controllers\BKD\SDMController;
use App\Http\Controllers\BKD\KompetensiController;
use App\Http\Controllers\BKD\KualifikasiController;
use App\Http\Controllers\BKD\PelaksPendidikanController;
use App\Http\Controllers\BKD\PelaksPenelitian;
use App\Http\Controllers\BKD\PelaksPengabdian;
use App\Http\Controllers\BKD\PenunjangController;
use App\Http\Controllers\BKD\ProfilController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Presence\FilePresenceController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Utils\Mail\MailController;

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

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'form')->name('form.login');
    Route::post('login', 'login')->name('login');
    Route::post('logout', 'logout')->name('logout');
});

Route::prefix('auth')->controller(SocialiteController::class)->group(function () {
    Route::get('/google', 'redirectToProvider');
    Route::get('/google/callback', 'handleProvideCallback');
});

Route::get('/', [Controller::class, 'index'])->name('index');
// Route::get('/send', [MailController::class, 'presences']);

Route::get('/verify', [Controller::class, 'verify']);
Route::post('/presence-mahasiswa/{meeting_id}', [Controller::class, 'presenceMahasiswa'])->name('presence.mahasiswa');

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
});

Route::middleware('auth')->group(function () {
    Route::prefix("/admin")->group(function () {
        Route::get('comments', [Controller::class, 'allComments'])->name('comments');
        Route::prefix('structure')->group(function () {
            Route::delete('delete/{sdm_id}/{structural_id}', [StructuralPositionController::class, 'removeStructuralPosition'])->name('structure.delete');
            Route::resource("/assign", StructuralPositionController::class)->except(['index', 'show']);
        });
        Route::resource("/structure", StructureController::class);
        Route::resource("/human_resource", HumanResourceController::class);
        Route::resource("/semester", SemesterController::class)->except('show');
    });
    Route::prefix("/")->group(function () {
        Route::resource("/class", ClassController::class)->except('show');
        Route::prefix('subject')->controller(SubjectController::class)->group(function () {
            Route::get('/my-subject', 'mySubject')->name('subject.my-subject');
            Route::get('/by-subdivision', 'subDivision')->name('subject.by-subdivision');
            Route::get('/lecturer-list', 'lecturerList')->name('subject.lecturer-list');
            Route::get('/{sdm_id}/by-lecturer/{semester_id?}', 'byLecturer')->name('subject.by-lecturer');
        });
        Route::resource("/subject", SubjectController::class);
        Route::resource("/meeting", MeetingController::class);
        Route::prefix('presence')->controller(PresenceController::class)->group(function () {
            Route::get('/my-presence', 'myPresence')->name('presence.my-presence');
            Route::get('/detail/{sdm_id}', 'detail')->name('presence.detail');
            Route::get('/sub-lecturer', 'subLecturer')->name('presence.sub-lecturer');
            Route::get('/all-lecturer', 'allLecturer')->name('presence.all-lecturer');
            Route::get('/per-civitas', 'subPresenceByCivitas')->name('presence.per-civitas');
            Route::get('/civitas-all', 'subPresenceAll')->name('presence.civitas-all');
            Route::get('/dsdm-civitas', 'dsdmByCivitas')->name('presence.dsdm-civitas');
            Route::get('/dsdm-civitas-all', 'dsdmAllCivitas')->name('presence.dsdm-civitas-all');
            Route::prefix('permission')->group(function () {
                Route::get('/', 'form')->name('presence.absen');
                Route::get('/my-absen', 'myPermission')->name('presence.my-absen');
                Route::get('/sub', 'subPermission')->name('presence.sub.permission');
                Route::post('/', 'permission')->name('presence.permission');
                Route::post('/{presence}', 'confirm')->name('presence.confirm');
                Route::delete('/{presence}', 'delete')->name('presence.delete');
            });
            Route::prefix('download')->controller(FilePresenceController::class)->group(function () {
                Route::get('/my-presence', 'myPresence')->name('download.my-presence');
                Route::get('/per-civitas', 'perCivitas')->name('download.per-civitas');
                Route::get('/civitas-all', 'subPresenceAll')->name('download.civitas-all');
                Route::get('/detail/{sdm_id}', 'detail')->name('download.detail');
                Route::get('/sub-lecturer', 'subLecturer')->name('download.sub-lecturer');
                Route::get('/{sdm_id}/by-lecturer/{semester_id?}', 'byLecturer')->name('download.by-lecturer');
                Route::get('/dsdm-civitas', 'dsdmByCivitas')->name('download.dsdm-civitas');
                Route::get('/dsdm-civitas-all', 'dsdmAllCivitas')->name('download.dsdm-civitas-all');
                Route::get('/all-lecturer', 'allLecturer')->name('download.all-lecturer');
            });
        });
        Route::resource("/presence", PresenceController::class)->except('show');
        Route::prefix('prodi')->group(function () {
            Route::get('/', [ProdiController::class, 'index'])->name('prodi.list');
        });
        Route::prefix('fakultas')->group(function () {
        });
    });
});
