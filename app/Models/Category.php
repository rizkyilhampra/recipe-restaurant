<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

final class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * @return HasMany<Recipe,$this>
     */
    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class, 'category_id', 'id');
    }

    /**
     * Define an accessor for the "name" attribute.
     */
    protected function name(): Attribute
    {
        return Attribute::make(get: fn (string $value) => Str::apa($value));
    }
}
