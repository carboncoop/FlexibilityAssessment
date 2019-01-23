<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        for ($i = 1; $i < 5; $i++) {
            DB::table('assessments')->insert([
                'name' => "Assessment " . $i,
                'description' => 'No desc',
                'data' => '{}',
                'owner_id'=> 1
            ]);
        }
        for ($i = 1; $i < 5; $i++) {
            DB::table('assessments')->insert([
                'name' => "Assessment " . $i,
                'description' => 'No desc',
                'data' => '{}',
                'owner_id'=> 2
            ]);
        }
    }

}
