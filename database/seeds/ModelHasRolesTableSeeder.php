<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_roles')->delete();

        DB::table('model_has_roles')->insert(array(
            array('role_id' => '1','model_type' => 'App\\User','model_id' => '1'),
            array('role_id' => '2','model_type' => 'App\\User','model_id' => '2'),
          ));
    }
}
