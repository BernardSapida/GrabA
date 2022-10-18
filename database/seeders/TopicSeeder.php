<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Life Change Seeder
        DB::table('topics')->insert([
            'title' => 'Salvation',
            'event_id' => 1,
        ]);
        DB::table('topics')->insert([
            'title' => 'Repentance',
            'event_id' => 1,
        ]);
        DB::table('topics')->insert([
            'title' => 'Believe',
            'event_id' => 1,
        ]);
        DB::table('topics')->insert([
            'title' => 'Baptism',
            'event_id' => 1,
        ]);
        DB::table('topics')->insert([
            'title' => 'Faith',
            'event_id' => 1,
        ]);

        //Life Preparation Seeder
        DB::table('topics')->insert([
            'title' => 'Orientation',
            'event_id' => 2,
        ]);
        DB::table('topics')->insert([
            'title' => 'Four Wonderful Opportunities',
            'event_id' => 2,
        ]);
        DB::table('topics')->insert([
            'title' => 'New Birth',
            'event_id' => 2,
        ]);
        DB::table('topics')->insert([
            'title' => 'The Life Retreat',
            'event_id' => 2,
        ]);
        //Life Retreat Seeder
        DB::table('topics')->insert([
            'title' => 'Encounter the Cross',
            'event_id' => 3,
        ]);
        DB::table('topics')->insert([
            'title' => 'Encounter Yourself',
            'event_id' => 3,
        ]);
        DB::table('topics')->insert([
            'title' => 'Encounter Jesus',
            'event_id' => 3,
        ]);
        DB::table('topics')->insert([
            'title' => 'Encounter the Father',
            'event_id' => 3,
        ]);
        DB::table('topics')->insert([
            'title' => 'Encounter the Holy Spirit',
            'event_id' => 3,
        ]);
        DB::table('topics')->insert([
            'title' => 'Breakthrough',
            'event_id' => 3,
        ]);
        DB::table('topics')->insert([
            'title' => 'I Want To Grow',
            'event_id' => 3,
        ]);
        DB::table('topics')->insert([
            'title' => 'I Want To Lead',
            'event_id' => 3,
        ]);
    }
}
