<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StructuresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('structures')->delete();
        
        \DB::table('structures')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role' => 'admin',
                'parent_id' => 'none',
                'child_id' => 'admin',
                'type' => 'struktural',
            ),
            1 => 
            array (
                'id' => 2,
                'role' => 'rektor',
                'parent_id' => 'admin',
                'child_id' => 'r',
                'type' => 'struktural',
            ),
            2 => 
            array (
                'id' => 3,
                'role' => 'wakil rektor 1',
                'parent_id' => 'r',
                'child_id' => 'wr1',
                'type' => 'struktural',
            ),
            3 => 
            array (
                'id' => 4,
                'role' => 'wakil rektor 2',
                'parent_id' => 'r',
                'child_id' => 'wr2',
                'type' => 'struktural',
            ),
            4 => 
            array (
                'id' => 5,
                'role' => 'wakil rektor 3',
                'parent_id' => 'r',
                'child_id' => 'wr3',
                'type' => 'struktural',
            ),
            5 => 
            array (
                'id' => 6,
                'role' => 'wakil rektor 4',
                'parent_id' => 'r',
                'child_id' => 'wr4',
                'type' => 'struktural',
            ),
            6 => 
            array (
                'id' => 7,
                'role' => 'pasca sarjana',
                'parent_id' => 'r',
                'child_id' => 'pasca',
                'type' => 'struktural',
            ),
            7 => 
            array (
                'id' => 18,
                'role' => 'Fakultas Rekaya Sistem',
                'parent_id' => 'r',
                'child_id' => '6395e2ca9ac8fFakultasRekayaSistem',
                'type' => 'fakultas',
            ),
            8 => 
            array (
                'id' => 19,
                'role' => 'Fakultas Bioteknologi dan Humaniora',
                'parent_id' => 'r',
                'child_id' => '6395e3683afd0FakultasBioteknologidanHumaniora',
                'type' => 'fakultas',
            ),
            9 => 
            array (
                'id' => 21,
                'role' => 'Teknik Sipil',
                'parent_id' => '6395e2ca9ac8fFakultasRekayaSistem',
                'child_id' => '6395e39294999TeknikSipil',
                'type' => 'prodi',
            ),
            10 => 
            array (
                'id' => 24,
                'role' => 'Bioteknologi',
                'parent_id' => '6395e3683afd0FakultasBioteknologidanHumaniora',
                'child_id' => '639752168ed01Bioteknologi',
                'type' => 'prodi',
            ),
            11 => 
            array (
                'id' => 25,
                'role' => 'Dosen',
                'parent_id' => '6395e39294999TeknikSipil',
                'child_id' => '6399746a760f9Dosen',
                'type' => 'dosen',
            ),
            12 => 
            array (
                'id' => 26,
                'role' => 'Staff Warek 4',
                'parent_id' => 'wr4',
                'child_id' => '639da682afc0bStaffWarek4',
                'type' => 'struktural',
            ),
            13 => 
            array (
                'id' => 27,
                'role' => 'Informatika',
                'parent_id' => '6395e2ca9ac8fFakultasRekayaSistem',
                'child_id' => '639eaf4cbac42Informatika',
                'type' => 'prodi',
            ),
            14 => 
            array (
                'id' => 28,
                'role' => 'Direktorat Sumber Daya Manusia',
                'parent_id' => 'wr1',
                'child_id' => '639eb26622219DirektoratSumberDayaManusia',
                'type' => 'struktural',
            ),
            15 => 
            array (
                'id' => 29,
                'role' => 'Direktorat Akademik',
                'parent_id' => 'wr1',
                'child_id' => '639eb2d054fd7DirektoratAkademik',
                'type' => 'struktural',
            ),
        ));
        
        
    }
}