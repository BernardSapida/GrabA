<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            'place' => 'Indang',
            'outreach_id' => 1,
        ]);
        DB::table('areas')->insert([
            'place' => 'T.A.M.A',
            'outreach_id' => 1,
        ]);
    }
}
