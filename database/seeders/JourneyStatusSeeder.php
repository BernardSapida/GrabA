<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class JourneyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('journey_statuses')->insert([
            'title' => 'New',
        ]);
        DB::table('journey_statuses')->insert([
            'title' => 'Ongoing Life Change',
        ]);
        DB::table('journey_statuses')->insert([
            'title' => 'For Life Retreat',
        ]);
        DB::table('journey_statuses')->insert([
            'title' => 'Life Retreat Graduate',
        ]);
        DB::table('journey_statuses')->insert([
            'title' => 'Ongoing Mentors Training Program',
        ]);
        DB::table('journey_statuses')->insert([
            'title' => 'Mentors Training Program Graduate',
        ]);
        DB::table('journey_statuses')->insert([
            'title' => 'Ongoing Leaders Training Program',
        ]);
        DB::table('journey_statuses')->insert([
            'title' => 'Leaders Training Program Graduate',
        ]);
        DB::table('journey_statuses')->insert([
            'title' => 'Ongoing Advanced Life Coaching',
        ]);
        DB::table('journey_statuses')->insert([
            'title' => 'Advanced Life Coaching Graduate',
        ]);
        DB::table('journey_statuses')->insert([
            'title' => 'Ongoing Kainos',
        ]);
        DB::table('journey_statuses')->insert([
            'title' => 'Kainos Graduate',
        ]);
    }
}
