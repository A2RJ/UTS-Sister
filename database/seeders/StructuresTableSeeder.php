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
                'id' => 1,
                'role' => 'admin',
                'parent_id' => 'none',
                'child_id' => 'admin',
            ),
            1 =>
            array(
                'id' => 2,
                'role' => 'rektor',
                'parent_id' => 'admin',
                'child_id' => 'r',
            ),
            2 =>
            array(
                'id' => 3,
                'role' => 'wakil rektor 1',
                'parent_id' => 'r',
                'child_id' => 'wr1',
            ),
            3 =>
            array(
                'id' => 4,
                'role' => 'wakil rektor 2',
                'parent_id' => 'r',
                'child_id' => 'wr2',
            ),
            4 =>
            array(
                'id' => 5,
                'role' => 'wakil rektor 3',
                'parent_id' => 'r',
                'child_id' => 'wr3',
            ),
            5 =>
            array(
                'id' => 6,
                'role' => 'wakil rektor 4',
                'parent_id' => 'r',
                'child_id' => 'wr4',
            ),
            6 =>
            array(
                'id' => 7,
                'role' => 'pasca sarjana',
                'parent_id' => 'r',
                'child_id' => 'pasca',
            ),
            7 =>
            array(
                'id' => 18,
                'role' => 'Fakultas Rekaya Sistem',
                'parent_id' => 'r',
                'child_id' => '6395e2ca9ac8fFakultasRekayaSistem',
            ),
            8 =>
            array(
                'id' => 19,
                'role' => 'Fakultas Bioteknologi dan Humaniora',
                'parent_id' => 'r',
                'child_id' => '6395e3683afd0FakultasBioteknologidanHumaniora',
            ),
            9 =>
            array(
                'id' => 20,
                'role' => 'Informatika',
                'parent_id' => '6395e2ca9ac8fFakultasRekayaSistem',
                'child_id' => '6395e380de236Informatika',
            ),
            10 =>
            array(
                'id' => 21,
                'role' => 'Teknik Sipil',
                'parent_id' => '6395e2ca9ac8fFakultasRekayaSistem',
                'child_id' => '6395e39294999TeknikSipil',
            ),
            11 =>
            array(
                'id' => 22,
                'role' => 'Bioteknologi',
                'parent_id' => '6395e3683afd0FakultasBioteknologidanHumaniora',
                'child_id' => '6395e3bf4c00fBioteknologi',
            ),
        ));
    }
}
