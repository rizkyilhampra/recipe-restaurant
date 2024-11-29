<?php

use App\Models\Ingredient;

it('returns expected keys', function () {
    $ingredient = Ingredient::factory()->make();

    expect($ingredient->getAttributes())->toHaveKeys(['name']);
});
