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
                'latitude_in' => '0',
                'longitude_in' => '0',
                'check_in_time' => '2022-12-18T16:26',
                'check_out_time' => '2022-12-18T23:01',
                'latitude_out' => NULL,
                'longitude_out' => NULL,
                'created_at' => '2022-12-18 08:44:53',
                'updated_at' => '2022-12-18 09:01:40',
            ),
            1 => 
            array (
                'id' => 2,
                'sdm_id' => 237,
                'latitude_in' => '0',
                'longitude_in' => '0',
                'check_in_time' => '2022-12-19T17:00',
                'check_out_time' => '2022-12-20T06:00',
                'latitude_out' => NULL,
                'longitude_out' => NULL,
                'created_at' => '2022-12-18 09:02:28',
                'updated_at' => '2022-12-18 09:02:55',
            ),
            2 => 
            array (
                'id' => 3,
                'sdm_id' => 98,
                'latitude_in' => '0',
                'longitude_in' => '0',
                'check_in_time' => '2022-12-18 22:08:07',
                'check_out_time' => NULL,
                'latitude_out' => NULL,
                'longitude_out' => NULL,
                'created_at' => '2022-12-18 22:08:07',
                'updated_at' => '2022-12-18 22:08:07',
            ),
            3 => 
            array (
                'id' => 4,
                'sdm_id' => 98,
                'latitude_in' => '80',
                'longitude_in' => '80',
                'check_in_time' => '2022-12-18 22:11:08',
                'check_out_time' => '2022-12-18 22:28:52',
                'latitude_out' => '90',
                'longitude_out' => '90',
                'created_at' => '2022-12-18 22:11:08',
                'updated_at' => '2022-12-18 22:28:52',
            ),
            4 => 
            array (
                'id' => 5,
                'sdm_id' => 98,
                'latitude_in' => '90',
                'longitude_in' => '90',
                'check_in_time' => '2022-12-18 22:18:59',
                'check_out_time' => NULL,
                'latitude_out' => NULL,
                'longitude_out' => NULL,
                'created_at' => '2022-12-18 22:18:59',
                'updated_at' => '2022-12-18 22:18:59',
            ),
        ));
        
        
    }
}