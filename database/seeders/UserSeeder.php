<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'role' => 'admin',
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'password' => Hash::make('password')
            ],
            [
                'role' => 'cashier',
                'name' => 'Alfian Muhammad',
                'username' => '0012305567',
                'password' => Hash::make('password')
            ],
            [
                'role' => 'cashier',
                'name' => 'Deny Sumargo',
                'username' => '0012305569',
                'password' => Hash::make('password')
            ],
            [
                'role' => 'cashier',
                'name' => 'Billie Elish',
                'username' => '0012305569',
                'password' => Hash::make('password')
            ]
        ]);
    }
}
