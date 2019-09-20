<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role= DB::table('roles')->first();
        $users= DB::table('users')->get();

        if (!empty($users)) 
        {
        	foreach ($users as $user) 
        	{
        		$dataInsert = [
        			'user_id'=>$user->id,
        			'role_id'=>$role->id,
        		];
        		DB::table('role_users')->insert($dataInsert);
        	}
        }
    }
}
