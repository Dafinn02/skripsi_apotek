<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satuan = [
            'Ampul',
            'Batang',
            'Biji',
            'Botol',
            'Box',
            'Buah',
            'Bungkus',
            'Butir',
            'cc',
            'cm',
            'Dosin',
            'DUS',
            'Flakon',
            'Fls',
            'Galon',
            'gram',
            'Ikat',
            'Iris',
            'Kaleng',
            'Kapsul',
            'Karton',
            'Karung',
            'kg',
            'Kotak',
            'L',
            'Lembar',
            'm',
            'mg',
            'mL',
            'mm',
            'Pcs',
            'Plabot',
            'Pot',
            'Pound',
            'Sachet',
            'Satuan',
            'Sloki',
            'Strip',
            'Supp',
            'Tablet',
            'Tube',
            'Unit'
        ];

        foreach ($satuan as $s) {
            DB::table('units')->insert([
                'name' => $s
            ]);
        }
    }
}
