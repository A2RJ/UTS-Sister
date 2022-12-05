<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     *
     * Warek 3 search parent
     * Roles::where("parent_id", $role->parent_id)->get()
     *
     * Warek 3 search child
     * Roles::where("parent_id", $role->child_id)->get()
     */
    public function run()
    {
        Role::truncate();
        Role::create([
            [
                "role" => "rektor",
                "parent_id" => "none",
                "child_id" => "r",
            ],
            [
                "role" => "wakil rektor 1",
                "parent_id" => "r",
                "child_id" => "wr1"
            ],
            [
                "role" => "wakil rektor 2",
                "parent_id" => "r",
                "child_id" => "wr2"
            ],
            [
                "role" => "wakil rektor 3",
                "parent_id" => "r",
                "child_id" => "wr3"
            ],
            [
                "role" => "wakil rektor 4",
                "parent_id" => "r",
                "child_id" => "wr4"
            ],
            [
                "role" => "direktorat akademik",
                "parent_id" => "wr1",
                "child_id" => "dir_akademik"
            ],
            [
                "role" => "direktorat sistem dan teknologi informasi",
                "parent_id" => "wr3",
                "child_id" => "dsti"
            ],
        ]);
    }
}
