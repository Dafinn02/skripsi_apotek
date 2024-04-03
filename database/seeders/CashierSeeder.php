<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CashierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cashiers')->insert([
            [
                'user_id' => 2,
                'name' => 'Alfian Muhammad',
                'number' => '0012305567',
                'address'=> ' Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141',
                'phone'=> '085608014234'
            ],
            [
                'user_id' => 3,
                'name' => 'Deny Sumargo',
                'number' => '0012305569',
                'address'=> ' Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141',
                'phone'=> '085608014239'
            ],
            [
                'user_id' => 4,
                'name' => 'Billie Elish',
                'number' => '0012305569',
                'address'=> ' Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141',
                'phone'=> '085608014238'
            ]
        ]);
    }
}
