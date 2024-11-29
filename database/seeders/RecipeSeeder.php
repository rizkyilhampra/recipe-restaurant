<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(['Rendang', 'Sate Ayam', 'Gado-Gado', 'Soto Ayam', 'Bakso', 'Ayam Penyet', 'Pempek', 'Rawon', 'Martabak Manis'])
            ->each(fn (string $name) => Recipe::factory()->create(['name' => $name]));

        Recipe::factory()->create([
            'name' => 'nasi goreng',
            'category_id' => Category::query()->where('name', 'main course')->firstOrCreate()->id,
        ]);
    }
}