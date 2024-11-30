<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

final class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name'];

    /**
     * @return BelongsToMany<Recipe,$this>
     */
    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(
            Recipe::class,
            'recipe_ingredient',
            'ingredient_id',
            'recipe_id'
        )->using(RecipeIngredient::class);
    }

    /**
     * Define an accessor for the "name" attribute.
     */
    protected function name(): Attribute
    {
        return Attribute::make(get: fn (string $value) => Str::apa($value));
    }
}
