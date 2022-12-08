<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudyProgram::insert([
            [
                'faculty_id' => 1,
                'study_program' => 'informatika'
            ],
            [
                'faculty_id' => 1,
                'study_program' => 'teknik sipil'
            ],
            [
                'faculty_id' => 1,
                'study_program' => 'teknik mesin'
            ]
        ]);
    }
}
