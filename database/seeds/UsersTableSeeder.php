<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $roles = ["administrator", "assessor", "guest"];
        for ($i = 1; $i <= 3; $i++) {
            DB::table('users')->insert([
                'name' => "User " . $i,
                'email' => 'user' . $i . '@org1.com',
                'organisation_id' => 1,
                'role' => $roles[$i - 1],
                'password' => bcrypt('password')
            ]);
        }
        for ($i = 1; $i <= 3; $i++) {
            DB::table('users')->insert([
                'name' => "User " . $i,
                'email' => 'user' . $i . '@org2.com',
                'organisation_id' => 2,
                'role' => $roles[$i - 1],
                'password' => bcrypt('password')
            ]);
        }
    }

}
