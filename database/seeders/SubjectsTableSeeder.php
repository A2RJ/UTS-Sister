<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('subjects')->delete();

        \DB::table('subjects')->insert(array(
            0 =>
            array(
                'class_id' => 2,
                'id' => 1,
                'number_of_meetings' => 16,
                'sdm_id' => 98,
                'semester_id' => 1,
                'sks' => 4,
                'subject' => 'Dasar pemrograman web',
            ),
            1 =>
            array(
                'class_id' => 2,
                'id' => 2,
                'number_of_meetings' => 16,
                'sdm_id' => 98,
                'semester_id' => 1,
                'sks' => 4,
                'subject' => 'Matematika diskrit',
            ),
            2 =>
            array(
                'class_id' => 2,
                'id' => 3,
                'number_of_meetings' => 16,
                'sdm_id' => 98,
                'semester_id' => 1,
                'sks' => 4,
                'subject' => 'Matematika sidkrit',
            ),
        ));
    }
}
