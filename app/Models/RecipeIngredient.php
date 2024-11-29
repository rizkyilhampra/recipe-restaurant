<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

final class RecipeIngredient extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $table = 'recipe_ingredient';
}
