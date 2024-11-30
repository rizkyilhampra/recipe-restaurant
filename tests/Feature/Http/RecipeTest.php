<?php

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;

it('displays a list of recipes', function () {
    $recipes = Recipe::factory()->count(3)->create();

    $response = get(route('recipes.index'));

    $response->assertStatus(200);
    $response->assertViewIs('recipes.index');
    $response->assertViewHas('recipes');
});

it('shows the create recipe form', function () {
    $categories = Category::factory()->count(3)->create();
    $ingredients = Ingredient::factory()->count(5)->create();

    $response = get(route('recipes.create'));

    $response->assertStatus(200);
    $response->assertViewIs('recipes.create');
    $response->assertViewHas('categories');
    $response->assertViewHas('ingredients');
});

it('creates a new recipe with ingredients', function () {
    $category = Category::factory()->create();
    $ingredients = Ingredient::factory()->count(2)->create();

    $recipeData = [
        'name' => 'Test Recipe',
        'category_id' => $category->id,
        'ingredients' => [
            [
                'name' => $ingredients[0]->name,
                'quantity' => '2 cups',
                'description' => 'Chopped',
            ],
            [
                'name' => 'New Ingredient',
                'quantity' => '1 tbsp',
                'description' => 'Minced',
            ],
        ],
    ];

    $response = post(route('recipes.store'), $recipeData);

    $recipe = Recipe::query()->where('name', 'Test Recipe')->first();

    $response->assertRedirect(route('recipes.show', $recipe));
    assertDatabaseHas('recipes', [
        'name' => 'Test Recipe',
        'category_id' => $category->id,
    ]);
    assertCount(2, $recipe->ingredients);
});

it('shows a specific recipe', function () {
    $recipe = Recipe::factory()->create();
    $recipe->load('category', 'ingredients');

    $response = get(route('recipes.show', $recipe));

    $response->assertStatus(200);
    $response->assertViewIs('recipes.show');
    $response->assertViewHas('recipe');
});

it('shows the edit recipe form', function () {
    $recipe = Recipe::factory()->create();
    $categories = Category::factory()->count(3)->create();
    $ingredients = Ingredient::factory()->count(5)->create();

    $response = get(route('recipes.edit', $recipe));

    $response->assertStatus(200);
    $response->assertViewIs('recipes.edit');
    $response->assertViewHas('recipe');
    $response->assertViewHas('categories');
    $response->assertViewHas('ingredients');
});

it('updates an existing recipe', function () {
    $recipe = Recipe::factory()->create();
    $newCategory = Category::factory()->create();
    $existingIngredient = Ingredient::factory()->create();
    $newIngredient = Ingredient::factory()->make();

    $updateData = [
        'name' => 'Updated Recipe Name',
        'category_id' => $newCategory->id,
        'ingredients' => [
            [
                'name' => $existingIngredient->name,
                'quantity' => '3 cups',
                'description' => 'Sliced',
            ],
            [
                'name' => $newIngredient->name,
                'quantity' => '1/2 cup',
                'description' => 'Diced',
            ],
        ],
    ];

    $response = put(route('recipes.update', $recipe), $updateData);

    $recipe->refresh();

    $response->assertRedirect(route('recipes.show', $recipe));
    assertEquals('Updated Recipe Name', $recipe->name);
    assertEquals($newCategory->id, $recipe->category_id);
    assertCount(2, $recipe->ingredients);
});

it('deletes a recipe', function () {
    $recipe = Recipe::factory()->create();

    $response = delete(route('recipes.destroy', $recipe));

    $response->assertRedirect(route('recipes.index'));
    assertDatabaseMissing('recipes', ['id' => $recipe->id]);
});
