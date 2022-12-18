<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PresencesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('presences')->delete();
        
        \DB::table('presences')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sdm_id' => 237,
                'check_in_time' => '2022-12-18T16:26',
                'check_out_time' => '2022-12-18T23:01',
                'created_at' => '2022-12-18 08:44:53',
                'updated_at' => '2022-12-18 09:01:40',
            ),
            1 => 
            array (
                'id' => 2,
                'sdm_id' => 237,
                'check_in_time' => '2022-12-19T17:00',
                'check_out_time' => '2022-12-20T06:00',
                'created_at' => '2022-12-18 09:02:28',
                'updated_at' => '2022-12-18 09:02:55',
            ),
        ));
        
        
    }
}