<?php

use Illuminate\Database\Seeder;

class OrganisationsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        for ($i = 1; $i < 3; $i++) {
            DB::table('organisations')->insert([
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
    }

}
