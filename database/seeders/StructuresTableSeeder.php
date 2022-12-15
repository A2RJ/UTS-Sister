<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StructuresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('structures')->delete();

        DB::table('structures')->insert(array(
            0 =>
            array(
                'child_id' => 'admin',
                'id' => 1,
                'parent_id' => 'none',
                'role' => 'admin',
                'type' => 'struktural',
            ),
            1 =>
            array(
                'child_id' => 'r',
                'id' => 2,
                'parent_id' => 'admin',
                'role' => 'rektor',
                'type' => 'struktural',
            ),
            2 =>
            array(
                'child_id' => 'wr1',
                'id' => 3,
                'parent_id' => 'r',
                'role' => 'wakil rektor 1',
                'type' => 'struktural',
            ),
            3 =>
            array(
                'child_id' => 'wr2',
                'id' => 4,
                'parent_id' => 'r',
                'role' => 'wakil rektor 2',
                'type' => 'struktural',
            ),
            4 =>
            array(
                'child_id' => 'wr3',
                'id' => 5,
                'parent_id' => 'r',
                'role' => 'wakil rektor 3',
                'type' => 'struktural',
            ),
            5 =>
            array(
                'child_id' => 'wr4',
                'id' => 6,
                'parent_id' => 'r',
                'role' => 'wakil rektor 4',
                'type' => 'struktural',
            ),
            6 =>
            array(
                'child_id' => 'pasca',
                'id' => 7,
                'parent_id' => 'r',
                'role' => 'pasca sarjana',
                'type' => 'struktural',
            ),
            7 =>
            array(
                'child_id' => '6395e2ca9ac8fFakultasRekayaSistem',
                'id' => 18,
                'parent_id' => 'r',
                'role' => 'Fakultas Rekaya Sistem',
                'type' => 'fakultas',
            ),
            8 =>
            array(
                'child_id' => '6395e3683afd0FakultasBioteknologidanHumaniora',
                'id' => 19,
                'parent_id' => 'r',
                'role' => 'Fakultas Bioteknologi dan Humaniora',
                'type' => 'fakultas',
            ),
            9 =>
            array(
                'child_id' => '6395e39294999TeknikSipil',
                'id' => 21,
                'parent_id' => '6395e2ca9ac8fFakultasRekayaSistem',
                'role' => 'Teknik Sipil',
                'type' => 'prodi',
            ),
            10 =>
            array(
                'child_id' => '639752168ed01Bioteknologi',
                'id' => 24,
                'parent_id' => '6395e3683afd0FakultasBioteknologidanHumaniora',
                'role' => 'Bioteknologi',
                'type' => 'prodi',
            ),
            11 =>
            array(
                'child_id' => '6399746a760f9Dosen',
                'id' => 25,
                'parent_id' => '6395e39294999TeknikSipil',
                'role' => 'Dosen',
                'type' => 'dosen',
            ),
        ));
    }
}
