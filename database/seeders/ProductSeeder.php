<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Paracetamol',
                'code'=>'PRC',
                'supplier_id'=>'1',
                'unit_id'=>'1',
                'category_id'=>'1',
                'price'=>'15000',
                'active_zat'=>'active zat 1',
                'power_shape'=>'berat',
                'min_stock'=>'10',
                'max_stock'=>'100',
                'stock'=>'0',
                'recipe'=>'yes'
            ],
            [
                'name' => 'Amoksilin',
                'code'=>'AMK',
                'supplier_id'=>'2',
                'unit_id'=>'2',
                'category_id'=>'2',
                'price'=>'16000',
                'active_zat'=>'active zat 1',
                'power_shape'=>'berat',
                'min_stock'=>'10',
                'max_stock'=>'50',
                'stock'=>'0',
                'recipe'=>'no'
            ],
            [
                'name' => 'Diapet',
                'code'=>'DPT',
                'supplier_id'=>'3',
                'unit_id'=>'3',
                'category_id'=>'3',
                'price'=>'10000',
                'active_zat'=>'active zat 1',
                'power_shape'=>'ringan',
                'min_stock'=>'10',
                'max_stock'=>'50',
                'stock'=>'0',
                'recipe'=>'no'
            ]
        ]);
    }
}
