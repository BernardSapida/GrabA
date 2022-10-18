<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LgReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lg_reports')->insert([
            'year' => '2022',
            'month' => 'January',
            'member_id' => 1,
            'outreach_id' => 1,
        ]);
    }
}
