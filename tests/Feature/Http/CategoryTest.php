<?php

use App\Models\Category;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

it('can display a list of categories', function () {
    $categories = Category::factory()->count(3)->create();

    get(route('categories.index'))
        ->assertStatus(200)
        ->assertViewIs('categories.index')
        ->assertViewHas('categories', function ($viewCategories) {
            return $viewCategories->count() === 3;
        });
});

it('shows the create category form', function () {
    get(route('categories.create'))
        ->assertStatus(200)
        ->assertViewIs('categories.create');
});

it('can create a new category', function () {
    $categoryData = [
        'name' => 'Test Category',
        'description' => 'This is a test category',
    ];

    post(route('categories.store'), $categoryData)
        ->assertRedirect(route('categories.index'));

    assertDatabaseHas('categories', $categoryData);
});

it('can show a specific category', function () {
    $category = Category::factory()->create();

    get(route('categories.show', $category))
        ->assertStatus(200)
        ->assertViewIs('categories.show')
        ->assertViewHas('category');
});

it('shows the edit form for a category', function () {
    $category = Category::factory()->create();

    get(route('categories.edit', $category))
        ->assertStatus(200)
        ->assertViewIs('categories.edit')
        ->assertViewHas('category');
});

it('can update a category', function () {
    $category = Category::factory()->create();

    $updatedData = [
        'name' => 'Updated Category Name',
        'description' => 'This is an updated category description',
    ];

    put(route('categories.update', $category), $updatedData)
        ->assertRedirect(route('categories.index'));

    assertDatabaseHas('categories', $updatedData);
});

it('can delete a category', function () {
    $category = Category::factory()->create();

    delete(route('categories.destroy', $category))
        ->assertRedirect(route('categories.index'));

    assertDatabaseMissing('categories', [
        'id' => $category->id,
    ]);
});
