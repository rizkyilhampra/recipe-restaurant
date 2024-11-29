<?php

use App\Models\Recipe;

it('returns expected keys', function () {
    $recipe = Recipe::factory()->make();

    expect($recipe->getAttributes())
        ->toHaveKeys([
            'name',
            'category_id',
        ]);
});
