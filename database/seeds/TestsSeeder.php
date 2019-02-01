<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestsSeeder extends Seeder {

    /**
     * Run the database seeds for the tests.
     *
     * @return void
     */
    public function run() {

        // Insert organisations
        $orgs_ids = [];
        for ($i = 1; $i < 3; $i++) {
            $orgs_ids[] = DB::table('organisations')->insertGetId([
                'name' => "Organisation " . $i,
                'email' => 'org' . $i . '@org' . $i . '.com',
                'telephone' => '0007778888999',
                'address1' => 'Address1 ' . "Organisation " . $i,
                'address2' => 'Address2 ' . "Organisation " . $i,
                'postcode_zones' => "ASDS ASD ASD",
                'city_town' => 'Glasgow',
                'postcode' => 'GM12 A12'
            ]);
        }


        // Insert users
        $roles = ["administrator", "assessor", "invited"];
        $users_ids = [];
        foreach ($orgs_ids as $org_index => $org_id) {
            for ($i = 1; $i <= 3; $i++) {
                $users_ids[] = DB::table('users')->insertGetId([
                    'name' => $roles[$i - 1],
                    'email' => $roles[$i - 1] . '@org' . (1 + (int) $org_index) . '.com',
                    'organisation_id' => $org_id,
                    'role' => $roles[$i - 1],
                    'password' => bcrypt('password')
                ]);
            }
        }


        // Insert assessments
        $roles = ['administrator', 'assessor', 'invited', 'administrator', 'assessor', 'invited'];
        for ($index = 0; $index < count($users_ids); $index++) {
            for ($i = 1; $i < 5; $i++) {
                DB::table('assessments')->insert([
                    'name' => "Assessment " . $i,
                    'description' => 'Belongs to ' . $roles[$index],
                    'data' => '{}',
                    'owner_id' => $users_ids[$index]
                ]);
            }
        }
    }

}
