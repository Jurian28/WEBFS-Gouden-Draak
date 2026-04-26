<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'menu_number' => 1,
                'menu_affix' => null,
                'name' => 'Soep Ling Fa',
                'price' => 3.8,
                'type_dish' => 'SOEP',
                'description' => null,
            ],
            [
                'menu_number' => 2,
                'menu_affix' => null,
                'name' => 'Kippensoep',
                'price' => 2.9,
                'type_dish' => 'SOEP',
                'description' => '',
            ],
            [
                'menu_number' => 3,
                'menu_affix' => null,
                'name' => 'Tomatensoep',
                'price' => 2.9,
                'type_dish' => 'SOEP',
                'description' => null,
            ],
            [
                'menu_number' => 4,
                'menu_affix' => null,
                'name' => 'Haaienvinnensoep',
                'price' => 3.1,
                'type_dish' => 'SOEP',
                'description' => null,
            ],
            [
                'menu_number' => 5,
                'menu_affix' => null,
                'name' => 'Champignonsoep',
                'price' => 3.3,
                'type_dish' => 'SOEP',
                'description' => null,
            ],
            [
                'menu_number' => 6,
                'menu_affix' => null,
                'name' => 'Pekingsoep',
                'price' => 3.8,
                'type_dish' => 'SOEP',
                'description' => null,
            ],
            [
                'menu_number' => 7,
                'menu_affix' => null,
                'name' => 'Wan Tan Soep',
                'price' => 4.3,
                'type_dish' => 'SOEP',
                'description' => null,
            ],
            [
                'menu_number' => 8,
                'menu_affix' => null,
                'name' => 'Chinese Champignonsoep',
                'price' => 4.1,
                'type_dish' => 'SOEP',
                'description' => null,
            ],

            [
                'menu_number' => 10,
                'menu_affix' => null,
                'name' => 'Loempia Ling Fa',
                'price' => 6.2,
                'type_dish' => 'VOORGERECHT',
                'description' => 'met atjar, ananas en pindasaus',
            ],
            [
                'menu_number' => 11,
                'menu_affix' => null,
                'name' => 'Loempia Compleet',
                'price' => 6.2,
                'type_dish' => 'VOORGERECHT',
                'description' => 'met gesmoord rundvlees en pikante saus',
            ],
            [
                'menu_number' => 12,
                'menu_affix' => null,
                'name' => 'Loempia met Kip',
                'price' => 3.9,
                'type_dish' => 'VOORGERECHT',
                'description' => null,
            ],
            [
                'menu_number' => 13,
                'menu_affix' => null,
                'name' => 'Loempia',
                'price' => 3.8,
                'type_dish' => 'VOORGERECHT',
                'description' => null,
            ],
            [
                'menu_number' => 14,
                'menu_affix' => null,
                'name' => 'Chinese mini loempia',
                'price' => 4.9,
                'type_dish' => 'VOORGERECHT',
                'description' => '4 st.',
            ],
            [
                'menu_number' => 14,
                'menu_affix' => 'A',
                'name' => 'Vegetarische mini loempia',
                'price' => 4.9,
                'type_dish' => 'VOORGERECHT',
                'description' => '12 st.',
            ],
            [
                'menu_number' => 15,
                'menu_affix' => null,
                'name' => 'Kroepoek',
                'price' => 2.5,
                'type_dish' => 'VOORGERECHT',
                'description' => null,
            ],
            [
                'menu_number' => 15,
                'menu_affix' => 'A',
                'name' => 'Casave Kroepoek',
                'price' => 2.7,
                'type_dish' => 'VOORGERECHT',
                'description' => null,
            ],
        ];

        foreach ($data as $dish) {
            DB::table('dishes')->insert($dish);
            DB::table('dishes')->insert($dish);
            DB::table('dishes')->insert($dish);
            DB::table('dishes')->insert($dish);
        }
    }
}
