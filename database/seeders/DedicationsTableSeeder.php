<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DedicationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dedications')->delete();
        
        \DB::table('dedications')->insert(array (
            0 => 
            array (
                'start_date' => '2023-07-21',
                'end_date' => null,
                'as' => 'asdasdsd',
                'created_at' => '2023-07-21 11:11:24',
                'funding_amount' => '12312312',
                'funding_source' => 'sadasd',
                'id' => 1,
                'location' => 'sadasd',
                'participants' => '[{"name": "asdasd", "nidn": "213123", "detail": "wkwkwk", "studyProgram": "asdasd"}, {"name": "asda", "nidn": "234234234", "detail": "asdasdasd", "studyProgram": "asd"}]',
                'proposal_file' => 'proposal_file_1689909084_64b9f75c6f9bb.docx',
                'public_media_publications' => 'asdasd',
                'role' => 'Staff Prodi Teknik Sipil',
                'scientific_publications' => 'asdasdasd',
                'sdm_id' => 237,
                'target_activity_outputs' => 'asdasd',
                'theme' => 'asdasd',
                'title' => 'asdasd',
                'updated_at' => '2023-07-24 12:13:47',
            ),
        ));
        
        
    }
}