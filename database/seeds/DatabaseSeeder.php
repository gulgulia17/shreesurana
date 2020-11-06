<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert(
            array(
                array(
                    'name' => 'Admin',
                    'email' => 'admin@admin.com',
                    'username' => 'admin',
                    'number' => '8890070352',
                    'email_verified_at' => NULL,
                    'password' => '$2y$10$V5AuZ2QWTQccwe9qAosXeeXiO.etTsaaQfGmIEfEQXtj8oQMpl7.i',
                    'api_token' => 'MULUoJUTGPzMD4MTjkZVCkNh5W5nLSdGxgCDbArEEiqRxIfXRM52dFLTmkFhHdrwmqTK9eRJxHlh9fhN',
                    'type' => 'Admin',
                    'remember_token' => NULL,
                    'created_at' => '2020-10-03 16:58:52',
                    'updated_at' => '2020-10-03 16:58:52'
                ),
                array(
                    'name' => 'User',
                    'email' => 'user@user.com',
                    'username' => 'user',
                    'number' => '8005751424',
                    'email_verified_at' => NULL,
                    'password' => '$2y$10$V5AuZ2QWTQccwe9qAosXeeXiO.etTsaaQfGmIEfEQXtj8oQMpl7.i',
                    'api_token' => 'MULUoJUTGPzMD4MTjkZVCkNh5W5nLSdGxgCDbArEEiqRxIfXRM52dFLTmkFhHdrwmqTK9eRJxHlh9fhU',
                    'type' => 'User',
                    'remember_token' => NULL,
                    'created_at' => '2020-10-03 16:58:52',
                    'updated_at' => '2020-10-03 16:58:52'
                ),
            )
        );
        // $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
    }
}
