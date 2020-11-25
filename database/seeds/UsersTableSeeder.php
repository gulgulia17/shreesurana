<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Reliable Avisore',
                'email' => 'admin@reliableadvisore.com',
                'username' => 'admin',
                'number' => '8005751424',
                'email_verified_at' => NULL,
                'password' => '$2y$10$VcbOY0PSo8U62azgGWzuy.ExOInNMso0HpCpqXbr3BdMGadiC5qVe',
                'api_token' => 'MULUoJUTGPzMD4MTjkZVCkNh5W5nLSdGxgCDbArEEiqRxIfXRM52dFLTmkFhHdrwmqTK9eRJxHlh9fhN',
                'type' => 'Admin',
                'remember_token' => NULL,
                'created_at' => '2020-10-03 16:58:52',
                'updated_at' => '2020-10-03 16:58:52',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Reliable Avisore Moderator',
                'email' => 'moderator@reliableadvisore.com',
                'username' => 'user',
                'number' => '8890070352',
                'email_verified_at' => NULL,
                'password' => '$2y$10$VcbOY0PSo8U62azgGWzuy.ExOInNMso0HpCpqXbr3BdMGadiC5qVe',
                'api_token' => 'MULUoJUTGPzMD4MTjkbVCkNh5W5nLSdGxgCDbArEEiqRxIfXRM52dFLTmkFhHdrwmqTK9eRJxHlh9fhN',
                'type' => 'User',
                'remember_token' => NULL,
                'created_at' => '2020-10-03 16:58:52',
                'updated_at' => '2020-10-03 16:58:52',
                'deleted_at' => NULL,
            ),
        ));
    }
}