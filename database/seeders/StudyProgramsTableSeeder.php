<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudyProgramsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('study_programs')->delete();
        
        \DB::table('study_programs')->insert(array (
            0 => 
            array (
                'faculty_id' => 2,
                'id' => 1,
                'study_program' => 'teknik metalurgi',
            ),
            1 => 
            array (
                'faculty_id' => 1,
                'id' => 2,
                'study_program' => 'teknik mesin',
            ),
            2 => 
            array (
                'faculty_id' => 1,
                'id' => 3,
                'study_program' => 'informatika',
            ),
            3 => 
            array (
                'faculty_id' => 4,
                'id' => 4,
                'study_program' => 'bioteknologi',
            ),
            4 => 
            array (
                'faculty_id' => 6,
                'id' => 5,
                'study_program' => 'manajemen',
            ),
            5 => 
            array (
                'faculty_id' => 6,
                'id' => 6,
                'study_program' => 'akuntansi',
            ),
            6 => 
            array (
                'faculty_id' => 6,
                'id' => 7,
                'study_program' => 'ekonomi pembangunan',
            ),
            7 => 
            array (
                'faculty_id' => 5,
                'id' => 8,
                'study_program' => 'teknologi hasil pertanian',
            ),
            8 => 
            array (
                'faculty_id' => 5,
                'id' => 9,
                'study_program' => 'teknologi industri pertanian',
            ),
            9 => 
            array (
                'faculty_id' => 6,
                'id' => 10,
                'study_program' => 'ilmu komunikasi',
            ),
            10 => 
            array (
                'faculty_id' => 7,
                'id' => 11,
                'study_program' => 'psikologi',
            ),
            11 => 
            array (
                'faculty_id' => 2,
                'id' => 12,
                'study_program' => 'teknik elektro',
            ),
            12 => 
            array (
                'faculty_id' => 2,
                'id' => 13,
                'study_program' => 'teknik industri',
            ),
            13 => 
            array (
                'faculty_id' => 2,
                'id' => 14,
                'study_program' => 'teknik sipil',
            ),
            14 => 
            array (
                'faculty_id' => 3,
                'id' => 15,
                'study_program' => 'manajemen inovasi',
            ),
            15 => 
            array (
                'faculty_id' => 4,
                'id' => 16,
                'study_program' => 'peternakan',
            ),
            16 => 
            array (
                'faculty_id' => 2,
                'id' => 17,
                'study_program' => 'teknik lingkungan',
            ),
            17 => 
            array (
                'faculty_id' => 4,
                'id' => 18,
                'study_program' => 'ilmu perikanan',
            ),
            18 => 
            array (
                'faculty_id' => 6,
                'id' => 19,
                'study_program' => 'kewirausahaan',
            ),
            19 => 
            array (
                'faculty_id' => 6,
                'id' => 20,
                'study_program' => 'bisnis digital',
            ),
            20 => 
            array (
                'faculty_id' => 4,
                'id' => 21,
                'study_program' => 'ilmu aktuaria',
            ),
            21 => 
            array (
                'faculty_id' => 8,
                'id' => 22,
                'study_program' => 'ilmu hukum',
            ),
            22 => 
            array (
                'faculty_id' => 7,
                'id' => 23,
                'study_program' => 'sosiologi',
            ),
            23 => 
            array (
                'faculty_id' => 6,
                'id' => 24,
                'study_program' => 'ilmu pemerintahan',
            ),
            24 => 
            array (
                'faculty_id' => 2,
                'id' => 25,
                'study_program' => 'teknik sistem energi',
            ),
            25 => 
            array (
                'faculty_id' => 2,
                'id' => 26,
                'study_program' => 'konservasi sumber daya alam',
            ),
            26 => 
            array (
                'faculty_id' => 2,
                'id' => 27,
                'study_program' => 'teknik pertambangan',
            ),
        ));
        
        
    }
}