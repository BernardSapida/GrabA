<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'name' => 'Project 1',
            'location' => 'Indang, Cavite',
            'total_cost' => 123456,
            'user_id'=> 1,
            'fullname' => 'Daniel Watson',
            'position' => 'site engineer'
        ]);
        DB::table('projects')->insert([
            'name' => 'Project 2',
            'location' => 'Indang, Cavite',
            'total_cost' => 10000,
            'user_id'=> 1,
            'fullname' => 'Sarah Admin',
            'position' => 'site engineer'
        ]);
    }
}
