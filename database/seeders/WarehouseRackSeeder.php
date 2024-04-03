<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class WarehouseRackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('warehouse_racks')->insert([
            [
                'warehouse_id' => '1',
                'rack_id'=>'1'
            ],
            [
                'warehouse_id' => '1',
                'rack_id'=>'2'
            ],
            [
                'warehouse_id' => '2',
                'rack_id'=>'1'
            ]
        ]);
    }
}
