<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'id' => 1,
            'user_type' => 'admin',
            'password' => Hash::make('test')
        ]);


        DB::table('users')->insert([
            'id' => 2,
            'user_type' => 'customer',
            'password' => Hash::make('test')
        ]);


        DB::table('users')->insert([
            'id' => 3,
            'user_type' => 'employee',
            'password' => Hash::make('test')
        ]);

        $this->call([
            DishSeeder::class,
            GuestSeeder::class,
            OrderSeeder::class,
            SaleSeeder::class,
            TableRosterSeeder::class,
            TableSeeder::class,
        ]);
    }
}
