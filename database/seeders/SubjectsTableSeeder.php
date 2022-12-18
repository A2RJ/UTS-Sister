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
        
        \DB::table('subjects')->insert(array (
            0 => 
            array (
                'id' => 1,
                'subject' => 'Dasar pemrograman web',
                'sks' => 4,
                'number_of_meetings' => 16,
                'child_id' => NULL,
                'class_id' => 2,
                'sdm_id' => 98,
            ),
            1 => 
            array (
                'id' => 2,
                'subject' => 'Matematika diskrit',
                'sks' => 4,
                'number_of_meetings' => 16,
                'child_id' => NULL,
                'class_id' => 3,
                'sdm_id' => 12,
            ),
            2 => 
            array (
                'id' => 3,
                'subject' => 'Matematika sidkrit',
                'sks' => 4,
                'number_of_meetings' => 16,
                'child_id' => NULL,
                'class_id' => 2,
                'sdm_id' => 12,
            ),
        ));
        
        
    }
}