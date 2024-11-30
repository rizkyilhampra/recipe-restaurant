@extends('layouts.app')

@section('content')
    <h1>Edit Recipes</h1>
    <form action="{{ route('recipes.update', $recipe) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Recipe Name:</label>
            <input type="text" id="name" name="name" value="{{ $recipe->name }}" required>
        </div>
        <div>
            <label for="name">Category:</label>
            <select name="category_id" id="category">
                @foreach ($categories as $category)
                    <option {{ $recipe->category->id === $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            @foreach ($recipe->ingredients as $recipeIngredient)
                <div>
                    <label for="name">Ingredients:</label>
                    <select name="ingredients[{{ $recipeIngredient }}][name]" id="ingredients">
                        @foreach ($ingredients as $ingredient)
                            <option {{ $recipeIngredient->id === $ingredient->id ? 'selected' : '' }}
                                value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="quantity">Quantity:</label>
                    <input type="text" id="quantity" value="{{ $recipeIngredient->pivot->quantity }}"
                        name="ingredients[{{ $recipeIngredient }}][quantity]">
                </div>
                <div>
                    <label for="description">Description:</label>
                    <textarea id="description" name="ingredients[{{ $recipeIngredient }}][description]">{{ $recipeIngredient->pivot->description }}</textarea>
                </div>
            @endforeach
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
