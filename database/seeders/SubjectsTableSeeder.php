<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('subjects')->delete();

        DB::table('subjects')->insert(array(
            0 =>
            array(
                'id' => 1,
                'subject' => 'Dasar pemrograman web',
                'sks' => 4,
                'number_of_meetings' => 16,
                'study_program_id' => 1,
                'sdm_id' => 237,
            ),
        ));
    }
}
