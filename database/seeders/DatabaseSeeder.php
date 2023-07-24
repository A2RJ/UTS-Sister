<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StructuresTableSeeder::class);
        $this->call(FacultiesTableSeeder::class);
        $this->call(StudyProgramsTableSeeder::class);
        $this->call(HumanResourcesTableSeeder::class);
        $this->call(StructuralPositionsTableSeeder::class);
        $this->call(ClassesTableSeeder::class);
        $this->call(SemestersTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(MeetingsTableSeeder::class);
        $this->call(PresencesTableSeeder::class);
        // $this->call(StudentsTableSeeder::class);
        // $this->call(StudentDetailsTableSeeder::class);
    }
}
