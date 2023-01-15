<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacultiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('faculties')->delete();
        
        \DB::table('faculties')->insert(array (
            0 => 
            array (
                'faculty' => 'fakultas rekaya sistem',
                'id' => 1,
            ),
            1 => 
            array (
                'faculty' => 'fakultas teknik lingkungan dan mineral',
                'id' => 2,
            ),
            2 => 
            array (
                'faculty' => 'sekolah pascasarjana',
                'id' => 3,
            ),
            3 => 
            array (
                'faculty' => 'fakultas ilmu dan teknologi hayati',
                'id' => 4,
            ),
            4 => 
            array (
                'faculty' => 'fakultas teknologi pertanian',
                'id' => 5,
            ),
            5 => 
            array (
                'faculty' => 'fakultas ekonomi dan bisnis',
                'id' => 6,
            ),
            6 => 
            array (
                'faculty' => 'fakultas psikologi dan humaniora',
                'id' => 7,
            ),
            7 => 
            array (
                'faculty' => 'fakultas ilmu sosial dan politik',
                'id' => 8,
            ),
        ));
        
        
    }
}