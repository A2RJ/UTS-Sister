<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeetingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('meetings')->delete();

        DB::table('meetings')->insert(array(
            0 =>
            array(
                'id' => 1,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 1',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            1 =>
            array(
                'id' => 2,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 2',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            2 =>
            array(
                'id' => 3,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 3',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            3 =>
            array(
                'id' => 4,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 4',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            4 =>
            array(
                'id' => 5,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 5',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            5 =>
            array(
                'id' => 6,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 6',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            6 =>
            array(
                'id' => 7,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 7',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            7 =>
            array(
                'id' => 8,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 8',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            8 =>
            array(
                'id' => 9,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 9',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            9 =>
            array(
                'id' => 10,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 10',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            10 =>
            array(
                'id' => 11,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 11',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            11 =>
            array(
                'id' => 12,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 12',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            12 =>
            array(
                'id' => 13,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 13',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            13 =>
            array(
                'id' => 14,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 14',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            14 =>
            array(
                'id' => 15,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 15',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
            15 =>
            array(
                'id' => 16,
                'subject_id' => 1,
                'meeting_name' => 'Pertemuan ke 16',
                'date' => NULL,
                'meeting_start' => NULL,
                'meeting_end' => NULL,
                'file_start' => NULL,
                'file_end' => NULL,
            ),
        ));
    }
}
