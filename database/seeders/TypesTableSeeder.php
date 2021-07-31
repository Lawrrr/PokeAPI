<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['pokemon_type_api_id' => 1, 'type' => 'normal'],
            ['pokemon_type_api_id' => 2, 'type' => 'fighting'],
            ['pokemon_type_api_id' => 3, 'type' => 'flying'],
            ['pokemon_type_api_id' => 4, 'type' => 'poison'],
            ['pokemon_type_api_id' => 5, 'type' => 'ground'],
            ['pokemon_type_api_id' => 6, 'type' => 'rock'],
            ['pokemon_type_api_id' => 7, 'type' => 'bug'],
            ['pokemon_type_api_id' => 8, 'type' => 'ghost'],
            ['pokemon_type_api_id' => 9, 'type' => 'steel'],
            ['pokemon_type_api_id' => 10, 'type' => 'fire'],
            ['pokemon_type_api_id' => 11, 'type' => 'water'],
            ['pokemon_type_api_id' => 12, 'type' => 'grass'],
            ['pokemon_type_api_id' => 13, 'type' => 'electric'],
            ['pokemon_type_api_id' => 14, 'type' => 'psychic'],
            ['pokemon_type_api_id' => 15, 'type' => 'ice'],
            ['pokemon_type_api_id' => 16, 'type' => 'dragon'],
            ['pokemon_type_api_id' => 17, 'type' => 'dark'],
            ['pokemon_type_api_id' => 18, 'type' => 'fairy'],
            ['pokemon_type_api_id' => 19, 'type' => 'unknown'],
            ['pokemon_type_api_id' => 20, 'type' => 'shadow']
        ];

        DB::table('types')->insert($types);
    }
}
