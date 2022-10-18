<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ID: 1
        DB::table('members')->insert([
            'firstname' => 'Test',
            'lastname' => 'Doe',
            'address' => 'Laguna',
            'birthday' => '1992/01/22',
            'mobile' => '09772611947',
            'email' => 'testdoe@email.com',
            'password' => Hash::make('Testdoe1.'),
            'is_mighty_warrior' => true,
            'pcg_id' => 2,
            'journey_status_id' => 11,
            'leadership_status_id' => 7,
            'outreach_id' => 1,
            'area_id' => 1,
            'ministry_id' => 8,
            'status_id' => 1,
            'network_id' => 1,
            'leader_id' => 1,
            'account_status' => 'ACTIVE',
        ]);
        //ID: 2
        DB::table('members')->insert([
            'firstname' => 'Neil',
            'lastname' => 'Tecson',
            'address' => 'Tanza, Cavite',
            'birthday' => '1994-09-09',
            'mobile' => '09152295449',
            'email' => 'neilstecson@gmail.com',
            'password' => Hash::make('Testdoe1.'),
            'is_mighty_warrior' => true,
            'pcg_id' => 2,
            'journey_status_id' => 11,
            'leadership_status_id' => 7,
            'outreach_id' => 1,
            'area_id' => 1,
            'ministry_id' => 8,
            'status_id' => 1,
            'network_id' => 1,
            'leader_id' => 1,
            'account_status' => 'ACTIVE',
        ]);
        //Neil's Network
        //ID: 3
        DB::table('members')->insert([
            'firstname' => 'Nigel',
            'lastname' => 'Andam',
            'address' => 'Indang, Cavite',
            'birthday' => '1998-08-01',
            'mobile' => '09557356251',
            'email' => 'nigelandam@gmail.com',
            'password' => Hash::make('Testdoe1.'),
            'is_mighty_warrior' => true,
            'pcg_id' => 2,
            'journey_status_id' => 10,
            'leadership_status_id' => 5,
            'outreach_id' => 1,
            'area_id' => 1,
            'ministry_id' => 7,
            'status_id' => 1,
            'network_id' => 2,
            'leader_id' => 2,
            'account_status' => 'ACTIVE',
        ]);
        //ID: 4
        DB::table('members')->insert([
            'firstname' => 'Nicole',
            'lastname' => 'Cayago',
            'address' => 'Mendez, Cavite',
            'birthday' => '1998-01-03',
            'mobile' => '09273851829',
            'email' => 'nicolecayago13@gmail.com',
            'password' => Hash::make('Testdoe1.'),
            'is_mighty_warrior' => true,
            'pcg_id' => 2,
            'journey_status_id' => 11,
            'leadership_status_id' => 6,
            'outreach_id' => 1,
            'area_id' => 1,
            'ministry_id' => 8,
            'status_id' => 1,
            'network_id' => 2,
            'leader_id' => 2,
            'account_status' => 'ACTIVE',
        ]);
        //ID: 5
        DB::table('members')->insert([
            'firstname' => 'Jozel Bryan',
            'lastname' => 'Terrible',
            'address' => 'Indang, Cavite',
            'birthday' => '1995-03-07',
            'mobile' => '09757146213',
            'email' => 'jbmterrible@gmail.com',
            'password' => Hash::make('Testdoe1.'),
            'is_mighty_warrior' => true,
            'pcg_id' => 2,
            'journey_status_id' => 10,
            'leadership_status_id' => 5,
            'outreach_id' => 1,
            'area_id' => 1,
            'ministry_id' => 8,
            'status_id' => 1,
            'network_id' => 2,
            'leader_id' => 2,
            'account_status' => 'ACTIVE',
        ]);
        //ID: 6
        DB::table('members')->insert([
            'firstname' => 'Reynaldo Jr',
            'lastname' => 'Olarve',
            'address' => 'Alfonso, Cavite',
            'birthday' => '1995-10-30',
            'mobile' => '09757051548',
            'email' => 'disciplerj@gmail.com',
            'password' => Hash::make('Testdoe1.'),
            'is_mighty_warrior' => true,
            'pcg_id' => 2,
            'journey_status_id' => 10,
            'leadership_status_id' => 5,
            'outreach_id' => 1,
            'area_id' => 1,
            'ministry_id' => 8,
            'status_id' => 1,
            'network_id' => 2,
            'leader_id' => 2,
            'account_status' => 'ACTIVE',
        ]);
        //ID: 7
        DB::table('members')->insert([
            'firstname' => 'Veronica',
            'lastname' => 'Punzalan',
            'address' => 'Alfonso, Cavite',
            'birthday' => '1995-10-30',
            'mobile' => '09757051548',
            'email' => 'veronicapunzalan@gmail.com',
            'password' => Hash::make('Testdoe1.'),
            'is_mighty_warrior' => true,
            'pcg_id' => 2,
            'journey_status_id' => 10,
            'leadership_status_id' => 5,
            'outreach_id' => 1,
            'area_id' => 1,
            'ministry_id' => 8,
            'status_id' => 1,
            'network_id' => 2,
            'leader_id' => 2,
            'account_status' => 'ACTIVE',
        ]);
        //Neil's Network

        //Nigel's Network
        //ID: 8
        DB::table('members')->insert([
            'firstname' => 'Krisly John',
            'lastname' => 'Dominguez',
            'address' => 'Indang, Cavite',
            'birthday' => '1999-07-04',
            'mobile' => '09083533291',
            'email' => 'krislyjohndominguez@gmail.com',
            'password' => Hash::make('Testdoe1.'),
            'is_mighty_warrior' => true,
            'pcg_id' => 1,
            'journey_status_id' => 7,
            'leadership_status_id' => 4,
            'outreach_id' => 1,
            'area_id' => 1,
            'ministry_id' => 6,
            'status_id' => 1,
            'network_id' => 3,
            'leader_id' => 3,
            'account_status' => 'ACTIVE',
        ]);
        //Nigel's Network

        //Nicole's Network
        //ID: 9
        DB::table('members')->insert([
            'firstname' => 'Azaleah Patrisse',
            'lastname' => 'Cosico',
            'address' => 'Tanza, Cavite',
            'birthday' => '2001-07-25',
            'mobile' => '09655087739',
            'email' => 'azaleaarbues03@gmail.com',
            'password' => Hash::make('Testdoe1.'),
            'is_mighty_warrior' => true,
            'pcg_id' => 1,
            'journey_status_id' => 5,
            'leadership_status_id' => 3,
            'outreach_id' => 1,
            'area_id' => 1,
            'ministry_id' => 7,
            'status_id' => 1,
            'network_id' => 4,
            'leader_id' => 4,
            'account_status' => 'ACTIVE',
        ]);
        //Nicole's Network

        //Jozel's Network
        //ID: 10
        DB::table('members')->insert([
            'firstname' => 'Jan Denniel',
            'lastname' => 'Escaño',
            'address' => 'Indang, Cavite',
            'birthday' => '1999-09-15',
            'mobile' => '09611851170',
            'email' => 'jandenniel.escano@gmail.com',
            'password' => Hash::make('Testdoe1.'),
            'is_mighty_warrior' => true,
            'pcg_id' => 2,
            'journey_status_id' => 8,
            'leadership_status_id' => 5,
            'outreach_id' => 1,
            'area_id' => 1,
            'ministry_id' => 5,
            'status_id' => 1,
            'network_id' => 5,
            'leader_id' => 5,
            'account_status' => 'ACTIVE',
        ]);
        //Jozel's Network

        //RJ's Network
        //ID: 11
        DB::table('members')->insert([
            'firstname' => 'Sean',
            'lastname' => 'Sierra',
            'address' => 'Indang, Cavite',
            'birthday' => '1999-09-15',
            'mobile' => '09751234567',
            'email' => 'seansierra@gmail.com',
            'password' => Hash::make('Testdoe1.'),
            'is_mighty_warrior' => true,
            'pcg_id' => 1,
            'journey_status_id' => 6,
            'leadership_status_id' => 3,
            'outreach_id' => 1,
            'area_id' => 1,
            'ministry_id' => 5,
            'status_id' => 1,
            'network_id' => 6,
            'leader_id' => 6,
            'account_status' => 'ACTIVE',
        ]);
        //RJ's Network

        //Veronica's Network
        //ID: 12
        DB::table('members')->insert([
            'firstname' => 'Khriztine Mae',
            'lastname' => 'Flora',
            'address' => 'Indang, Cavite',
            'birthday' => '1995-10-30',
            'mobile' => '09757051548',
            'email' => 'kmflora071921@gmail.com@gmail.com',
            'password' => Hash::make('Testdoe1.'),
            'is_mighty_warrior' => true,
            'pcg_id' => 2,
            'journey_status_id' => 8,
            'leadership_status_id' => 4,
            'outreach_id' => 1,
            'area_id' => 1,
            'ministry_id' => 8,
            'status_id' => 1,
            'network_id' => 7,
            'leader_id' => 7,
            'account_status' => 'ACTIVE',
        ]);
        //Veronica's Network
    }
}
