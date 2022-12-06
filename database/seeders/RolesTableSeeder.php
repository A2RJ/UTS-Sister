<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
     *
     * use child_id to relations with user,
     * buat table untuk simpan role dari user untuk simpan jika ada user dengan 2 role
     */
    public function run()
    {
        $roles = [
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
                "role" => "pasca sarjana",
                "parent_id" => "r",
                "child_id" => "pasca"
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
            [
                "role" => "direktorat jurnal dan publikasi",
                "parent_id" => "wr3",
                "child_id" => "jurnal"
            ],
            [
                "role" => "staff direktorat sistem dan teknologi informasi",
                "parent_id" => "dsti",
                "child_id" => "staffdsti"
            ],
            [
                "role" => "staff 4 direktorat sistem dan teknologi informasi",
                "parent_id" => "staffdsti",
                "child_id" => "staffdsti22"
            ],
            [
                "role" => "staff 5 direktorat sistem dan teknologi informasi",
                "parent_id" => "staffdsti22",
                "child_id" => "staffdsti3"
            ],
            [
                "role" => "staff 2 direktorat sistem dan teknologi informasi",
                "parent_id" => "dsti",
                "child_id" => "staffdsti2"
            ],
            [
                "role" => "staff dalam direktorat sistem dan teknologi informasi",
                "parent_id" => "staffdsti",
                "child_id" => "staffdalam"
            ],
            [
                "role" => "dekan fakultas rekaya sistem",
                "parent_id" => "dir_akademik",
                "child_id" => "frs"
            ],
            [
                "role" => "wakil dekan fakultas rekaya sistem",
                "parent_id" => "frs",
                "child_id" => "dfrs"
            ],
        ];

        Role::truncate();
        Role::insert($roles);
    }
}
