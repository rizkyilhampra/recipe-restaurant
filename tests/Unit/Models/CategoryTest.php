<?php

use App\Models\Category;

it('returns expected keys', function () {
    $category = Category::factory()->make();

    expect($category->getAttributes())->toHaveKeys(['name', 'description']);
});
