<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('classes')->delete();

        DB::table('classes')->insert(array(
            0 =>
            array(
                'id' => 1,
                'study_program_id' => 1,
                'class' => 'INF-2022-A',
            ),
            1 =>
            array(
                'id' => 2,
                'study_program_id' => 1,
                'class' => 'INF-2022-B',
            ),
        ));
    }
}
