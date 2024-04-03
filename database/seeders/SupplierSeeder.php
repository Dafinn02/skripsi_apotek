<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'PT. ABC',
                'email' => 'abc@gmail.com',
                'phone' => '08129956789',
                'pic' => 'Bapak Alfian',
                'address' => 'Jl. ABC No. 1',
            ],
            [
                'name' => 'PT. DEF',
                'email' => 'defpt@gmail.com',
                'phone' => '08123454289',
                'pic' => 'Bapak Budi',
                'address' => 'Jl. DEF No. 2',
            ],
            [
                'name' => 'PT. GHI',
                'email' => 'ghipt@gmail.com',
                'phone' => '08123456789',
                'pic' => 'Bapak Candra',
                'address' => 'Jl. GHI No. 3',
            ]
        ]);
    }
}
