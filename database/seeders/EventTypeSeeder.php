<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_types')->insert([
            'name' => 'Change Challenge',
            'is_required' => true,
        ]);
        DB::table('event_types')->insert([
            'name' => 'Mentoring',
            'is_required' => true,
        ]);
        DB::table('event_types')->insert([
            'name' => 'School of Discipleship',
            'is_required' => true,
        ]);
    }
}
