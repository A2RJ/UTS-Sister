<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\Admin\DSDMController;
use App\Http\Controllers\Admin\HumanResourceController;
use App\Http\Controllers\Admin\StructuralPositionController;
use App\Http\Controllers\Admin\StructureController;
use App\Http\Controllers\Akademik\ProdiController;
use App\Http\Controllers\Akademik\SemesterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Presence\FilePresenceController;
use App\Http\Controllers\Presence\PresencePermissionController;
use App\Http\Controllers\Presence\PresenceController;
use App\Http\Controllers\Presence\Teaching\ClassController;
use App\Http\Controllers\Presence\Teaching\MeetingController;
use App\Http\Controllers\Presence\Teaching\SubjectController;
use App\Http\Controllers\BKD\BkdController;
use App\Http\Controllers\BKD\SDMController;
use App\Http\Controllers\BKD\KompetensiController;
use App\Http\Controllers\BKD\KualifikasiController;
use App\Http\Controllers\BKD\PelaksPendidikanController;
use App\Http\Controllers\BKD\PelaksPenelitian;
use App\Http\Controllers\BKD\PelaksPengabdian;
use App\Http\Controllers\BKD\PenunjangController;
use App\Http\Controllers\BKD\ProfilController;
use App\Http\Controllers\Sub\JafungController;
use App\Http\Controllers\Sub\SubController;
use App\Http\Controllers\Verify\VerifyController;
use App\Http\Controllers\Wr3\DedicationController;
use App\Http\Controllers\Wr3\ProposalController;
use App\Http\Controllers\Wr3\RinovController;
use App\Models\HumanResource;
use App\Models\StudyProgram;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

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

include 'filament.php';

Route::prefix('/')->group(function () {
    Route::get('v/{s}/{t}', [VerifyController::class, 'verifyData'])->name('verify-qr');
    Route::controller(Controller::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('verify', 'verify');
        Route::post('presence-mahasiswa/{meeting_id}', 'presenceMahasiswa')->name('presence.mahasiswa');
    });
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
        Route::post('password/reset', 'reset')->name('password.update');
    });
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'sendResetLinkEmail')->name('password.email');
    });
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'form')->name('form.login');
        Route::post('login', 'login')->name('login');
        Route::middleware('auth')->group(function () {
            Route::get('change-password', 'changePassword')->name('auth.change-password');
            Route::post('change-password', 'updatePassword')->name('auth.update-password');
            Route::post('logout', 'logout')->name('logout');
        });
    });
});

Route::prefix('auth')->controller(SocialiteController::class)->group(function () {
    Route::get('/google', 'redirectToProvider');
    Route::get('/google/callback', 'handleProvideCallback');
});

Route::prefix('download')->controller(DownloadController::class)->group(function () {
    Route::get('presense/{filename}', 'presense')->name('download.presense');
    Route::get('meeting/{filename}', 'meeting')->name('download.meeting');
    Route::get('riset/{filename}', 'riset')->name('download.riset');
    Route::get('pengabdian/{filename}', 'pengabdian')->name('download.pengabdian');
});

Route::middleware('auth')->group(function () {
    Route::prefix('bkd')->controller(BkdController::class)->group(function () {
        Route::get('/import', 'import')->name('bkd.import');
        Route::post('/import', 'importPost')->name('bkd.import');
        Route::get('/remove-data', 'flushSession')->name('bkd.remove-session');
        Route::get('/store-bkd', 'storeBkd')->name('bkd.store-bkd');
    });
    Route::resource('/bkd', BkdController::class)->except('show');
    Route::prefix('jafung')->controller(JafungController::class)->group(function () {
        Route::get('/attachment/{path}', 'attachment')->name('jafung.attachment')->where('path', '.*');
    });
    Route::resource('/jafung', JafungController::class)->except('show');

    Route::prefix('sub')->controller(SubController::class)->group(function () {
        Route::get('/sub-unit', 'sub')->name('sub.sub');
        Route::get('/{sdm}', 'sdm')->name('sub.sdm');
        Route::get('profile/{sdm}', 'profile')->name('sub.profile');
    });

    Route::resource("/class", ClassController::class)->except('show');
    Route::prefix('subject')->controller(SubjectController::class)->group(function () {
        Route::get('/my-subject', 'mySubject')->name('subject.my-subject');
        Route::get('/by-subdivision', 'subDivision')->name('subject.by-subdivision');
        Route::get('/lecturer-list', 'lecturerList')->name('subject.lecturer-list');
        Route::get('/{sdm_id}/by-lecturer/{semester_id?}', 'byLecturer')->name('subject.by-lecturer');
    });
    Route::resource("/subject", SubjectController::class);
    Route::resource("/meeting", MeetingController::class);
    Route::prefix('presence')->group(function () {
        Route::controller(PresenceController::class)->group(function () {
            Route::get('/my-presence', 'myPresence')->name('presence.my-presence');
            Route::get('/sub', 'subPresence')->name('presence.sub-presence');
            Route::get('/per-civitas/{sdm_id}', 'perCivitas')->name('presence.per-civitas');
            Route::get('/per-unit/{structureId}', 'perUnit')->name('presence.per-unit');
        });
        Route::prefix('dsdm')->controller(DSDMController::class)->group(function () {
            Route::get('/', 'index')->name('dsdm.all-sdm');
        });
        Route::prefix('download')->controller(FilePresenceController::class)->group(function () {
            Route::get('/my', 'myPresence')->name('download.my-presence');
            Route::get('/sub', 'subPresence')->name('download.sub-presence');
            Route::get('/dsdm', 'dsdmPresence')->name('download.dsdm-presence');
            Route::get('/per-unit/{structureId}', 'unit')->name('download.per-unit-presence');
            Route::get('/per-civitas/{sdm_id}', 'civitas')->name('download.per-civitas-presence');
        });
        Route::prefix('permission')->controller(PresencePermissionController::class)->group(function () {
            Route::get('/', 'form')->name('presence.absen');
            Route::get('/my-presence-permission', 'myPermission')->name('permission.my-presence');
            Route::get('/sub', 'subPermission')->name('presence.sub.permission');
            Route::post('/', 'permission')->name('presence.permission');
            Route::post('/{presence}', 'confirm')->name('presence.confirm');
            Route::delete('/{presence}', 'decline')->name('presence.decline');
        });
    });
    Route::resource("/presence", PresenceController::class)->except('show');
    Route::prefix('prodi')->group(function () {
        Route::get('/', [ProdiController::class, 'index'])->name('prodi.list');
    });
    Route::prefix("/admin")->group(function () {
        Route::get('comments', [Controller::class, 'allComments'])->name('comments');
        Route::prefix('structure')->group(function () {
            Route::delete('delete/{sdm_id}/{structural_id}', [StructuralPositionController::class, 'removeStructuralPosition'])->name('structure.delete');
            Route::resource("/assign", StructuralPositionController::class)->except(['index', 'show']);
        });
        Route::resource("/structure", StructureController::class);
        Route::prefix('human_resource')->controller(HumanResourceController::class)->group(function () {
            Route::get('reset-password/{human_resource}', 'resetPassword')->name('human_resource.resetPassword');
            Route::put('reset-mac-address/{human_resource}', 'resetMacAddress')->name('human_resource.reset-mac-address');
        });
        Route::resource("/human_resource", HumanResourceController::class);
        Route::resource("/semester", SemesterController::class)->except('show');
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('warek-iii')->group(function () {
        Route::prefix('study-program')->group(function () {
            Route::get('/{faculty}', function ($faculty) {
                $studyProgram = StudyProgram::whereFacultyId($faculty)->get();
                return response($studyProgram);
            });
            Route::get('/{id}/first', function ($id) {
                $studyProgram = StudyProgram::whereId($id)->first();
                return response($studyProgram);
            });
        });

        Route::controller(RinovController::class)->group(function () {
            Route::get('/data-dosen', 'dataDosen')->name('rinov.data-dosen');
            Route::post('/data-dosen', 'postDataDosen')->name('rinov.post-data-dosen');
        });

        Route::prefix('proposal')->controller(ProposalController::class)->group(function () {
            Route::get('dosen', 'dosen')->name('proposal.by-user');
            Route::get('detail/{proposal}', 'show')->name('proposal.detail');
            Route::get('penomoran-surat/{proposal}', 'formNumbering')->name('proposal.formNumbering');
            Route::put('penomoran-surat/{proposal}', 'letterNumbering')->name('proposal.letterNumbering');
            Route::post('generate-letter/{proposal}', 'generateLetter')->name('proposal.generateLetter');
        });
        Route::resource('proposal', ProposalController::class);

        Route::prefix('dedication')->controller(DedicationController::class)->group(function () {
            Route::get('dedication-by-user', 'byUser')->name('dedication.by-user');
            Route::get('detail/{dedication}', 'show')->name('dedication.detail');
            Route::get('penomoran-surat/{dedication}', 'formNumbering')->name('dedication.formNumbering');
            Route::put('penomoran-surat/{dedication}', 'letterNumbering')->name('dedication.letterNumbering');
            Route::post('generate-letter/{dedication}', 'generateLetter')->name('dedication.generateLetter');
        });
        Route::resource('dedication', DedicationController::class);
    });
});

Route::middleware("auth")->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('bkd')->group(function () {
        Route::prefix("sdm")->controller(SDMController::class)->group(function () {
            Route::get('/', 'index')->name('sdm.index');
            Route::get('set-sdm/{sdm_id}/{sdm_name}', 'setSession')->name('sdm.set-sdm');
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

Route::prefix('nd8erjsdfjoir8wurfsf')->group(function () {
    Route::get('/heat-map', function () {
        $absensiCoordsIn = DB::table('presences')
            ->whereNotNull('latitude_in')
            ->whereNotNull('longitude_in')
            ->where('latitude_in', '!=', 0)
            ->where('longitude_in', '!=', 0)
            ->where('latitude_in', '!=', 80)
            ->where('longitude_in', '!=', 80)
            ->where('longitude_in', '!=', 90)
            ->where('longitude_in', '!=', 90)
            ->join('human_resources', 'presences.sdm_id', '=', 'human_resources.id')
            ->whereRaw("MONTH(presences.created_at) IN (8, 9, 10)")
            ->selectRaw('latitude_in as lat, longitude_in as lon, presences.id, presences.sdm_id, check_in_time as time, human_resources.sdm_name')
            ->get();

        $absensiCoordsOut = DB::table('presences')
            ->whereNotNull('latitude_out')
            ->whereNotNull('longitude_out')
            ->where('latitude_out', '!=', 0)
            ->where('longitude_out', '!=', 0)
            ->where('latitude_out', '!=', 80)
            ->where('longitude_out', '!=', 80)
            ->where('longitude_out', '!=', 90)
            ->where('longitude_out', '!=', 90)
            ->join('human_resources', 'presences.sdm_id', '=', 'human_resources.id')
            ->whereRaw("MONTH(presences.created_at) IN (8, 9, 10)")
            ->selectRaw('latitude_out as lat, longitude_out as lon, presences.id, presences.sdm_id, check_out_time as time, human_resources.sdm_name')
            ->get();


        $mergeCoords = array_merge($absensiCoordsIn->toArray(), $absensiCoordsOut->toArray());

        return view('maps.distance-point', compact('mergeCoords'));
    });
    Route::post('/download', function () {
        $data = request()->all();
        $mergeCoords = collect($data)->map(function ($item) {
            $sdmId = $item['sdm_id'];
            $id = $item['id'];
            $nama = strtoupper($item['sdm_name']);
            $tanggal = $item['time'];
            $link = "https://www.google.com/maps?q=" . $item['lat'] . ',' . $item['lon'];
            return [
                'sdm_id' => "$sdmId",
                'Absen ID' => "$id",
                'Nama' => strtoupper($nama),
                'Tanggal' => $tanggal,
                'Link' => $link,
            ];
        });

        $userId = $mergeCoords->pluck('sdm_id')->unique();
        $users = HumanResource::query()->whereIn('id', $userId)->get(['id', 'sdm_name']);
        $absensiCount = collect();
        foreach ($users as $user) {
            $count = $mergeCoords->where('sdm_id', $user->id)->count();
            $absensiCount->push(['Nama' => $user->sdm_name, 'Jumlah absen datang/pulang diluar kampus' => $count]);
        }

        $sheets = new SheetCollection([
            'Presensi' => $mergeCoords,
            'User' => $absensiCount
        ]);
        return (new FastExcel($sheets))->download('data absensi dan lokasi maps.xlsx');
    })->name('map.download');
});
