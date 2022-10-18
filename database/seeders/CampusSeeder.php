<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campuses')->insert([
            'name' => 'Cavite State University - Main Campus',
            'area_id' => 1,
            'outreach_id' => 1,
        ]);
    }
}
