<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Model\JourneyStatus;
use App\Models\JourneyStatus as ModelsJourneyStatus;

class TruncateJourneyStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $toTruncate = ['journey_statuses'];

    public function run()
    {
        Model::unguard();
        ModelsJourneyStatus::truncate();
        $this->call(JourneyStatusSeeder::class);
        Model::reguard();
    }
}
