<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        DB::table('roles')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Admin',
                'guard_name' => 'web',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'User',
                'guard_name' => 'web',
            ),
        ));
    }
}
