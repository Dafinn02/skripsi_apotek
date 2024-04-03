<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CashierSeeder::class,
            SupplierSeeder::class,
            CategorySeeder::class,
            UnitSeeder::class,
            ShiftSeeder::class,
            ProductSeeder::class,
            WarehouseSeeder::class,
            RackSeeder::class,
            WarehouseRackSeeder::class,
            CustomerSeeder::class,
        ]);
    }
}
