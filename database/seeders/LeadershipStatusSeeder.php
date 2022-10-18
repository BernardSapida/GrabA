<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadershipStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leadership_statuses')->insert([
            'title' => 'New',
        ]);
        DB::table('leadership_statuses')->insert([
            'title' => 'Mentee',
        ]);
        DB::table('leadership_statuses')->insert([
            'title' => 'Mentor',
        ]);
        DB::table('leadership_statuses')->insert([
            'title' => 'Lifegroup Leader',
        ]);
        DB::table('leadership_statuses')->insert([
            'title' => 'Life Coach',
        ]);
        DB::table('leadership_statuses')->insert([
            'title' => 'Campus Missionary',
        ]);
        DB::table('leadership_statuses')->insert([
            'title' => 'Pastor',
        ]);
    }
}
