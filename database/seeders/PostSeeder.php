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
                    "item_0": "Cement",
                    "unit_0": "bags",
                    "quantity_0": "20",
                    "unitCost_0": "240",
                    "amount_0": "4800"
                },
                {
                    "item_1": "Sand",
                    "unit_1": "cu. m.",
                    "quantity_1": "5",
                    "unitCost_1": "150",
                    "amount_1": "750"
                },
                {
                    "item_2": "Gravel",
                    "unit_2": "cu. m.",
                    "quantity_2": "10",
                    "unitCost_2": "200",
                    "amount_2": "2000"
                },
                {
                    "item_0": "CHB",
                    "unit_0": "pcs",
                    "quantity_0": "100",
                    "unitCost_0": "15",
                    "amount_0": "1500"
                }
            ]',
            'purpose' => 'Purpose 2',
            'hardware' => 'CPU',
            'position' => 'Site Engineer',
            'fullname' => "Bernard Sapida",
            'address' => "Tanza Cavite",
            'contact' => "09472126029",
            'project_id'=> 1
        ]);

        DB::table('posts')->insert([
            'materials' => '[
                {
                    "item_0": "Cement",
                    "unit_0": "bags",
                    "quantity_0": "20",
                    "unitCost_0": "235",
                    "amount_0": "4700"
                },
                {
                    "item_1": "CHB",
                    "unit_1": "pcs.",
                    "quantity_1": "100",
                    "unitCost_1": "15",
                    "amount_1": "1500"
                }
            ]',
            'purpose' => 'Purpose 2',
            'hardware' => 'CPU',
            'position' => 'Site Engineer',
            'fullname' => "Bernard Sapida",
            'address' => "Tanza Cavite",
            'contact' => "09472126029",
            'project_id'=> 1
        ]);

        DB::table('posts')->insert([
            'materials' => '[
                {
                    "item_0": "Cement",
                    "unit_0": "bags",
                    "quantity_0": "10",
                    "unitCost_0": "240",
                    "amount_0": "2400"
                },
                {
                    "item_1": "Sand",
                    "unit_1": "cu. m.",
                    "quantity_1": "2",
                    "unitCost_1": "150",
                    "amount_1": "300"
                },
                {
                    "item_2": "Gravel",
                    "unit_2": "cu. m.",
                    "quantity_2": "4",
                    "unitCost_2": "200",
                    "amount_2": "800"
                },
                {
                    "item_0": "CHB",
                    "unit_0": "pcs",
                    "quantity_0": "50",
                    "unitCost_0": "15",
                    "amount_0": "750"
                },
                {
                    "item_0": "Steel bars",
                    "unit_0": "pcs",
                    "quantity_0": "10",
                    "unitCost_0": "250",
                    "amount_0": "2500"
                },
                {
                    "item_0": "Paint",
                    "unit_0": "Gallon",
                    "quantity_0": "1",
                    "unitCost_0": "800",
                    "amount_0": "800"
                }
            ]',
            'purpose' => 'Purpose 2',
            'hardware' => 'CPU',
            'position' => 'Site Engineer',
            'fullname' => "Bernard Sapida",
            'address' => "Tanza Cavite",
            'contact' => "09472126029",
            'project_id'=> 1
        ]);
    }
}
