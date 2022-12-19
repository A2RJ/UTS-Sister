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
                'check_in_time' => '2022-12-18T16:26',
                'check_out_time' => '2022-12-18T23:01',
                'created_at' => '2022-12-18 08:44:53',
                'id' => 1,
                'latitude_in' => '0',
                'latitude_out' => NULL,
                'longitude_in' => '0',
                'longitude_out' => NULL,
                'sdm_id' => 12,
                'updated_at' => '2022-12-19 17:21:23',
            ),
            1 => 
            array (
                'check_in_time' => '2022-12-19T17:00',
                'check_out_time' => '2022-12-20T06:00',
                'created_at' => '2022-12-18 09:02:28',
                'id' => 2,
                'latitude_in' => '0',
                'latitude_out' => NULL,
                'longitude_in' => '0',
                'longitude_out' => NULL,
                'sdm_id' => 12,
                'updated_at' => '2022-12-19 17:21:23',
            ),
            2 => 
            array (
                'check_in_time' => '2022-12-18 22:08:07',
                'check_out_time' => NULL,
                'created_at' => '2022-12-18 22:08:07',
                'id' => 3,
                'latitude_in' => '0',
                'latitude_out' => NULL,
                'longitude_in' => '0',
                'longitude_out' => NULL,
                'sdm_id' => 98,
                'updated_at' => '2022-12-18 22:08:07',
            ),
            3 => 
            array (
                'check_in_time' => '2022-12-18 22:11:08',
                'check_out_time' => '2022-12-18 22:28:52',
                'created_at' => '2022-12-18 22:11:08',
                'id' => 4,
                'latitude_in' => '80',
                'latitude_out' => '90',
                'longitude_in' => '80',
                'longitude_out' => '90',
                'sdm_id' => 98,
                'updated_at' => '2022-12-18 22:28:52',
            ),
            4 => 
            array (
                'check_in_time' => '2022-12-18 22:18:59',
                'check_out_time' => NULL,
                'created_at' => '2022-12-18 22:18:59',
                'id' => 5,
                'latitude_in' => '90',
                'latitude_out' => NULL,
                'longitude_in' => '90',
                'longitude_out' => NULL,
                'sdm_id' => 98,
                'updated_at' => '2022-12-18 22:18:59',
            ),
            5 => 
            array (
                'check_in_time' => '2022-12-19T08:29',
                'check_out_time' => NULL,
                'created_at' => '2022-12-19 20:29:45',
                'id' => 6,
                'latitude_in' => '80',
                'latitude_out' => NULL,
                'longitude_in' => '80',
                'longitude_out' => NULL,
                'sdm_id' => 98,
                'updated_at' => '2022-12-19 20:29:45',
            ),
        ));
        
        
    }
}