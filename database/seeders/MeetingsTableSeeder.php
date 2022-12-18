<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MeetingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('meetings')->delete();
        
        \DB::table('meetings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 1',
                'date' => '2022-12-17T20:23',
                'meeting_start' => '2022-12-17T20:23',
                'file' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 2',
                'date' => '2022-12-18T13:37',
                'meeting_start' => '2022-12-18T13:37',
                'file' => '639ea7197d5841671341849download.jfif.jpg',
            ),
            2 => 
            array (
                'id' => 3,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 3',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 4',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 5',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 6',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 7',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 8',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 9',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 10',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 11',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 12',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 13',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 14',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 15',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 16',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 1',
                'date' => '2022-12-18T11:36',
                'meeting_start' => '2022-12-18T11:36',
                'file' => '639e8ab9a2e331671334585download.jfif.jpg',
            ),
            17 => 
            array (
                'id' => 18,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 2',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 3',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 4',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 5',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 6',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 7',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 8',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 9',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 10',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 11',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 12',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 13',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 14',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 15',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'subject_id' => 2,
                'meeting_name' => 'Pertemuan ke 16',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 1',
                'date' => '2022-12-18T13:36',
                'meeting_start' => '2022-12-18T13:36',
                'file' => '639ea700a03b81671341824-156-FULL-onic-akhirnya-YouTube.png.png',
            ),
            33 => 
            array (
                'id' => 34,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 2',
                'date' => '2022-12-18T13:37',
                'meeting_start' => '2022-12-18T13:37',
                'file' => '639ea735507271671341877download.jfif.jpg',
            ),
            34 => 
            array (
                'id' => 35,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 3',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 4',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 5',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 6',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 7',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 8',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 9',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 10',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 11',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 12',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 13',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 14',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 15',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'subject_id' => 3,
                'meeting_name' => 'Pertemuan ke 16',
                'date' => NULL,
                'meeting_start' => NULL,
                'file' => NULL,
            ),
        ));
        
        
    }
}