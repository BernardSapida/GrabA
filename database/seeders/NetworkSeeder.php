<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class NetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('networks')->insert([
            'name' => 'Default',
            'member_id' => 1,
            'outreach_id' => 1,
        ]);
        //Neil's Network
        DB::table('networks')->insert([
            'name' => 'Neil Network',
            'member_id' => 2,
            'outreach_id' => 1,
        ]);
        //Neil's Network

        //Nigel's Network
        DB::table('networks')->insert([
            'name' => 'Nigel Network',
            'member_id' => 3,
            'outreach_id' => 1,
        ]);
        //Nigel's Network

        //Nicole's Network
        DB::table('networks')->insert([
            'name' => 'Nicole Network',
            'member_id' => 4,
            'outreach_id' => 1,
        ]);
        //Nicole's Network

        //Jozel's Network
        DB::table('networks')->insert([
            'name' => 'Jozel Bryan Network',
            'member_id' => 5,
            'outreach_id' => 1,
        ]);
        //Jozel's Network

        //RJ's Network
        DB::table('networks')->insert([
            'name' => 'RJ Olarve Network',
            'member_id' => 6,
            'outreach_id' => 1,
        ]);
        //RJ's Network

        //Veronica's Network
        DB::table('networks')->insert([
            'name' => 'Veronica Network',
            'member_id' => 7,
            'outreach_id' => 1,
        ]);
        //Veronica's Network
    }
}
