<?php

use App\Models\Ingredient;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

it('can display a list of ingredients', function () {
    $ingredients = Ingredient::factory()->count(3)->create();

    get(route('ingredients.index'))
        ->assertStatus(200)
        ->assertViewIs('ingredients.index')
        ->assertViewHas('ingredients', function ($viewIngredients) {
            return $viewIngredients->count() === 3;
        });
});

it('shows the create ingredient form', function () {
    get(route('ingredients.create'))
        ->assertStatus(200)
        ->assertViewIs('ingredients.create');
});

it('can create a new ingredient', function () {
    $ingredientData = [
        'name' => 'Test Ingredient',
    ];

    post(route('ingredients.store'), $ingredientData)
        ->assertRedirect(route('ingredients.index'));

    assertDatabaseHas('ingredients', $ingredientData);
});

it('can show a specific ingredient', function () {
    $ingredient = Ingredient::factory()->create();

    get(route('ingredients.show', $ingredient))
        ->assertStatus(200)
        ->assertViewIs('ingredients.show')
        ->assertViewHas('ingredient');
});

it('shows the edit form for a ingredient', function () {
    $ingredient = Ingredient::factory()->create();

    get(route('ingredients.edit', $ingredient))
        ->assertStatus(200)
        ->assertViewIs('ingredients.edit')
        ->assertViewHas('ingredient');
});

it('can update a ingredient', function () {
    $ingredient = Ingredient::factory()->create();

    $updatedData = [
        'name' => 'Updated Ingredient Name',
    ];

    put(route('ingredients.update', $ingredient), $updatedData)
        ->assertRedirect(route('ingredients.index'));

    assertDatabaseHas('ingredients', $updatedData);
});

it('can delete a ingredient', function () {
    $ingredient = Ingredient::factory()->create();

    delete(route('ingredients.destroy', $ingredient))
        ->assertRedirect(route('ingredients.index'));

    assertDatabaseMissing('ingredients', [
        'id' => $ingredient->id,
    ]);
});
