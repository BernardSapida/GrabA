<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'materials' => '[
                {
                    "quantity": "199",
                    "unit": "10 M1",
                    "item": "Item 1",
                    "unitCost": "26000",
                    "amount": "26000"
                },
                {
                    "quantity": "199",
                    "unit": "10 M1",
                    "item": "Item 1",
                    "unitCost": "26000",
                    "amount": "26000"
                }
            ]',
            'purpose' => 'Purpose 2',
            'fullname' => "Bernard Sapida",
            'address' => "Tanza Cavite",
            'contact' => "09472126029",
            'project_id'=> 1
        ]);
        DB::table('posts')->insert([
            'materials' => '[
                {
                    "quantity": "199",
                    "unit": "10 M1",
                    "item": "Item 1",
                    "unitCost": "26000",
                    "amount": "26000"
                },
                {
                    "quantity": "199",
                    "unit": "10 M1",
                    "item": "Item 1",
                    "unitCost": "26000",
                    "amount": "26000"
                }
            ]',
            'purpose' => 'Purpose 2',
            'fullname' => "Christina Sapida",
            'address' => "Imus Cavite",
            'contact' => "09472126029",
            'project_id'=> 2
        ]);
    }
}
