<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('classes')->delete();
        
        \DB::table('classes')->insert(array (
            0 => 
            array (
                'id' => 2,
                'structure_id' => 21,
                'class' => 'SPL-2016-A1',
            ),
            1 => 
            array (
                'id' => 3,
                'structure_id' => 21,
                'class' => 'SPL-2016-B',
            ),
        ));
        
        
    }
}