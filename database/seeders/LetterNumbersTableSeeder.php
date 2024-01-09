<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LetterNumbersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('letter_numbers')->delete();
        
        \DB::table('letter_numbers')->insert(array (
            0 => 
            array (
                'created_at' => '2023-07-21 11:32:50',
                'dedication_id' => 1,
                'id' => 1,
                'month' => '12',
                'number' => '11',
                'proposal_id' => NULL,
                'updated_at' => '2023-07-21 11:32:50',
                'year' => '2023',
            ),
        ));
        
        
    }
}