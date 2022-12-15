<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StructuralPositionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('structural_positions')->delete();

        DB::table('structural_positions')->insert(array(
            0 =>
            array(
                'id' => 1,
                'sdm_id' => 238,
                'structure_id' => 2,
            ),
            1 =>
            array(
                'id' => 3,
                'sdm_id' => 237,
                'structure_id' => 5,
            ),
            2 =>
            array(
                'id' => 4,
                'sdm_id' => 129,
                'structure_id' => 18,
            ),
            3 =>
            array(
                'id' => 5,
                'sdm_id' => 98,
                'structure_id' => 21,
            ),
            4 =>
            array(
                'id' => 7,
                'sdm_id' => 237,
                'structure_id' => 1,
            ),
            5 =>
            array(
                'id' => 8,
                'sdm_id' => 98,
                'structure_id' => 25,
            ),
            6 =>
            array(
                'id' => 9,
                'sdm_id' => 12,
                'structure_id' => 25,
            ),
        ));
    }
}
