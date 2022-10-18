<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateOutreachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('outreaches')
            ->where('id', 1)
            ->update(['state_id' => 1]);
        DB::table('outreaches')
            ->where('id', 2)
            ->update(['state_id' => 1]);
    }
}
