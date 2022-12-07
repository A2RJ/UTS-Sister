<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('users')->delete();

        DB::table('users')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Ardiansyah putra',
                'email' => 'admin@admin.id',
                'email_verified_at' => NULL,
                'password' => '$2y$10$rBApUBKLVNa7jzJboUagHu/lhIXqTV126VNGoGV0WZZO0OmjPVfla',
                'remember_token' => NULL,
                'created_at' => '2022-12-07 03:30:26',
                'updated_at' => '2022-12-07 03:30:26',
            ),
        ));
    }
}
