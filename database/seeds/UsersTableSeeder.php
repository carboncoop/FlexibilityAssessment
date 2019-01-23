<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 3; $i++) {
            DB::table('users')->insert([
                'name' => "User " . $i,
                'email' => 'user'.$i.'@org1.com',
                'organisation_id'=> 1,
                'role'=>'admin',
                'password' => bcrypt('password')
            ]);
        }
        for ($i = 1; $i < 3; $i++) {
            DB::table('users')->insert([
                'name' => "User " . $i,
                'email' => 'user'.$i.'@org2.com',
                'organisation_id'=> 2,
                'role'=>'admin',
                'password' => bcrypt('password')
            ]);
        }
    }
}
