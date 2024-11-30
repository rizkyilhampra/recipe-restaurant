<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class RecipeController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $recipes = Recipe::query()
            ->orderByDesc('updated_at')
            ->get();

        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();
        $ingredients = Ingredient::query()
            ->orderBy('name')
            ->get();

        return view('recipes.create', compact('categories', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipeRequest $request): RedirectResponse
    {
        $recipe = Recipe::query()->create($request->only('name', 'category_id'));

        foreach ($request->input('ingredients') as $ingredientInput) {
            $ingredient = Ingredient::query()->firstOrCreate([
                'name' => $ingredientInput['name'],
            ]);

            $recipe->ingredients()->attach($ingredient, [
                'quantity' => $ingredientInput['quantity'],
                'description' => $ingredientInput['description'],
            ]);
        }

        return redirect()->route('recipes.show', $recipe);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe): View
    {
        $recipe->load('category', 'ingredients');

        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe): View
    {
        $recipe->load('category', 'ingredients');

        $ingredients = Ingredient::query()
            ->orderBy('name')
            ->get();
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('recipes.edit', compact('recipe', 'categories', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecipeRequest $request, Recipe $recipe): RedirectResponse
    {
        $recipe->update($request->only('name', 'category_id'));

        $recipe->ingredients()->detach();

        foreach ($request->input('ingredients') as $ingredientInput) {
            $ingredient = Ingredient::query()->firstOrCreate([
                'name' => $ingredientInput['name'],
            ]);

            $recipe->ingredients()->attach($ingredient, [
                'quantity' => $ingredientInput['quantity'],
                'description' => $ingredientInput['description'],
            ]);
        }

        return redirect()->route('recipes.show', $recipe);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe): RedirectResponse
    {
        $recipe->delete();

        return redirect()->route('recipes.index');
    }
}
