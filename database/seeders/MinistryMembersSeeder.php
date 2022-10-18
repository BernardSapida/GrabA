<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class MinistryMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ministry_members')->insert([
            'is_ministry_head' => 1,
            'ministry_id' => 1,
            'member_id' => 1,
            'outreach_id' => 1,
        ]);
    }
}
