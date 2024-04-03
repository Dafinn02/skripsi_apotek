<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shifts')->insert([
            [
                'name' => 'Pagi',
                'start_time'=>'07:30',
                'end_time'=>'12:30',
            ],
            [
                'name' => 'Siang',
                'start_time'=>'12:40',
                'end_time'=>'18:30',
            ],
            [
                'name' => 'Malam',
                'start_time'=>'18:40',
                'end_time'=>'12:30',
            ]
        ]);
    }
}
