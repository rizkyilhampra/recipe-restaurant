<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resources([
    'ingredients' => IngredientController::class,
    'categories' => CategoryController::class,
]);

