<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PcgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pcgs')->insert([
            'title' => 'Youth',
        ]);
        DB::table('pcgs')->insert([
            'title' => 'Adult',
        ]);
        DB::table('pcgs')->insert([
            'title' => 'Parents',
        ]);
    }
}
