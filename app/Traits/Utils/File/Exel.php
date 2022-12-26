<?php

namespace App\Traits\Utils\File;

use App\Models\HumanResource;
use Rap2hpoutre\FastExcel\FastExcel;

/**
 * Check atau send url()->current()
 * agar dapat cek query params
 * jika ada maka print sesuai dengan query params
 * ini berguna untuk print by semester, lecturer etc. 
 */

trait Exel
{
    // sdm
    public static function allSDMXlsx()
    {
        return (new FastExcel(HumanResource::all()))->download('SDM.xlsx', function ($sdm) {
            return [
                'SDM ID' => $sdm['sdm_id'],
                'Nama SDM' => $sdm['sdm_name'],
                'Email' => $sdm['email'],
                'NIDN' => $sdm['nidn'],
                'NIP' => $sdm['nip'],
                'Status Aktif' => $sdm['active_status_name'],
                'Status Kepegawaian' => $sdm['employee_status'],
                'Tipe SDM' => $sdm['sdm_type'],
                'Terdaftar Sister' => $sdm['is_sister_exist'] ? 'Ya' : 'Tidak'
            ];
        });
    }

    // presence civitas
    public static function allCivitasPresenceXlsx()
    {
        return 'allCivitasPresenceXlsx';
    }

    public static function allPresenceByCivitasXslx()
    {
        return 'allPresenceByCivitas';
    }

    public static function allSubCivitasPresenceXlsx()
    {
        return 'allSubCivitasPresenceXlsx';
    }

    public static function allSubPresenceByCivitasXslx()
    {
        return 'allSubPresenceByCivitasXslx';
    }

    // subject
    public static function allSubjectXslx() // program studi
    {
        return 'allSubjectXslx';
    }

    public static function allSubSubjectXslx()
    {
        return 'allSubSubjectXslx';
    }

    public static function allSubjectByLecturerXslx()
    {
        return 'allSubjectByLecturerXslx tombol print di halaman pengajaran by dosen';
    }
}
