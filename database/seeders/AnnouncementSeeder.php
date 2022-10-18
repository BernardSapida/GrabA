<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('announcements')->insert([
            'title' => 'Edge Council Meeting',
            'date' => '2022/02/05',
            'details' => 'Meeting for the preparation',
            'outreach_id' => 1,
        ]);
    }
}
