<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'name' => 'Andy Malarangin',
                'phone'=>'089786441234'
            ],
            [
                'name' => 'Setias Mahatir',
                'phone'=>'089786441235'
            ],
            [
                'name' => 'Hotman Paris',
                'phone'=>'089786441236'
            ]
        ]);
    }
}
