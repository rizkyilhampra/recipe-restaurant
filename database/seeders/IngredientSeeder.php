<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            'nasi',
            'telur',
            'minyak',
            'bawang merah',
            'bawang putih',
            'ayam',
            'sayur cesim',
            'kecap'
        ])->each(fn ($ingredient) => Ingredient::factory()->create(['name' => $ingredient]));
    }
}
