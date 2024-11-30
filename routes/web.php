<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

Route::resources([
    'recipes' => RecipeController::class,
    'ingredients' => IngredientController::class,
    'categories' => CategoryController::class,
]);
