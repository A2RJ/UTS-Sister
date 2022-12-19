<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SemestersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('semesters')->delete();

        \DB::table('semesters')->insert(array(
            0 =>
            array(
                'id' => 1,
                'semester' => 'Ganjil 2022/2023',
            ),
            1 =>
            array(
                'id' => 2,
                'semester' => 'Genap 2022/2023',
            ),
        ));
    }
}
