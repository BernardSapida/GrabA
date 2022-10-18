<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinistrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ministries')->insert([
            'title' => 'Music',
            'description' => 'Music Ministry',
        ]);
        DB::table('ministries')->insert([
            'title' => 'Dance',
            'description' => 'Dance Ministry',
        ]);
        DB::table('ministries')->insert([
            'title' => 'Ushering',
            'description' => 'Ushering Ministry',
        ]);
        DB::table('ministries')->insert([
            'title' => 'Hosting',
            'description' => 'Hosting Ministry',
        ]);
        DB::table('ministries')->insert([
            'title' => 'Production',
            'description' => 'Production Ministry',
        ]);
        DB::table('ministries')->insert([
            'title' => 'Media',
            'description' => 'Media Ministry',
        ]);
        DB::table('ministries')->insert([
            'title' => 'Prayer',
            'description' => 'Prayer Ministry',
        ]);
        DB::table('ministries')->insert([
            'title' => 'Journey',
            'description' => 'Journey Ministry',
        ]);
        DB::table('ministries')->insert([
            'title' => 'Reporting',
            'description' => 'Reporting Ministry',
        ]);
        DB::table('ministries')->insert([
            'title' => 'Kids',
            'description' => 'Kids Ministry',
        ]);
    }
}
