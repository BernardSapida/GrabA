<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::firstOrCreate([
            'state' => 'Cavite',
        ]);
        State::firstOrCreate([
            'state' => 'Laguna',
        ]);
    }
}
