<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            OutreachSeeder::class,
            AdminSeeder::class,
            PcgSeeder::class,
            JourneyStatusSeeder::class,
            LeadershipStatusSeeder::class,
            AnnouncementSeeder::class,
            AreaSeeder::class,
            CampusSeeder::class,
            WorkplaceSeeder::class,
            StatusSeeder::class,
            AnnouncementSeeder::class,
            MinistrySeeder::class,
            MemberSeeder::class,
            NetworkSeeder::class,
            MinistryMembersSeeder::class,
            SwsReportSeeder::class,
            LgReportSeeder::class,
            StateSeeder::class,
            EventTypeSeeder::class,
            EventSeeder::class,
            TopicSeeder::class,
        ]);
    }
}
