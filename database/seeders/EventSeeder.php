<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'title' => 'Life Change',
            'event_type_id' => 1,
            'status' => 'true',
            'order' => 1,
        ]);
        DB::table('events')->insert([
            'title' => 'Life Preparation',
            'event_type_id' => 1,
            'status' => 'true',
            'order' => 2,
        ]);
        DB::table('events')->insert([
            'title' => 'Life Retreat',
            'event_type_id' => 1,
            'status' => 'true',
            'order' => 3,
        ]);
        DB::table('events')->insert([
            'title' => 'DLV',
            'event_type_id' => 2,
            'status' => 'true',
            'order' => 1,
        ]);
        DB::table('events')->insert([
            'title' => 'MTP',
            'event_type_id' => 3,
            'status' => 'true',
            'order' => 1,
        ]);
        DB::table('events')->insert([
            'title' => 'LTP',
            'event_type_id' => 3,
            'status' => 'true',
            'order' => 2,
        ]);
        DB::table('events')->insert([
            'title' => 'ALC',
            'event_type_id' => 3,
            'status' => 'true',
            'order' => 3,
        ]);
        DB::table('events')->insert([
            'title' => 'ST',
            'event_type_id' => 3,
            'status' => 'true',
            'order' => 4,
        ]);
        DB::table('events')->insert([
            'title' => 'Kainos',
            'event_type_id' => 3,
            'status' => 'true',
            'order' => 5,
        ]);
    }
}
