<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert(
            array(
                array('id' => '1','name' => 'Admin','email' => 'admin@admin.com','username' => 'admin','number' => '8619777091','email_verified_at' => NULL,'password' => '$2y$10$VcbOY0PSo8U62azgGWzuy.ExOInNMso0HpCpqXbr3BdMGadiC5qVe','api_token' => 'MULUoJUTGPzMD4MTjkZVCkNh5W5nLSdGxgCDbArEEiqRxIfXRM52dFLTmkFhHdrwmqTK9eRJxHlh9fhN','type' => 'Admin','remember_token' => NULL,'created_at' => '2020-10-03 16:58:52','updated_at' => '2020-10-03 16:58:52'),
                array('id' => '2','name' => 'User','email' => 'user@user.com','username' => 'user','number' => '8823908641','email_verified_at' => NULL,'password' => '$2y$10$VcbOY0PSo8U62azgGWzuy.ExOInNMso0HpCpqXbr3BdMGadiC5qVe','api_token' => 'MULUoJUTGPzMD4MTjkbVCkNh5W5nLSdGxgCDbArEEiqRxIfXRM52dFLTmkFhHdrwmqTK9eRJxHlh9fhN','type' => 'Client','remember_token' => NULL,'created_at' => '2020-10-03 16:58:52','updated_at' => '2020-10-03 16:58:52'),
            )
        );
    }
}
