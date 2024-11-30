<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class NasiGorengRecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [
            'nasi' => '1 piring',
            'telur' => '2 buah',
            'minyak' => 'secukupnya',
            'bawang merah' => '5 siung',
            'bawah putih' => '5 siung',
            'ayam' => 'secukupnya',
            'sayur cesim' => '5 helai',
            'kecap' => 'secukupnya',
            'garam' => 'secukupnya',
        ];

        $recipe = Recipe::factory()->create([
            'name' => 'nasi goreng',
            'category_id' => Category::factory()->create(['name' => 'main course'])->id,
        ]);

        foreach ($ingredients as $name => $amount) {
            $ingredient = Ingredient::factory()->create(['name' => $name]);

            $recipe->ingredients()->attach($ingredient, ['quantity' => $amount]);
        }
    }
}
