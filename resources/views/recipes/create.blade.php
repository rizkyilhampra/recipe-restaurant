@extends('layouts.app')

@section('content')
    <h1>Create Recipes</h1>
    <form action="{{ route('recipes.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Recipe Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="name">Category:</label>
            <select name="category_id" id="category">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            @for ($i = 0; $i < 5; $i++)
                <div>
                    <label for="name">Ingredients:</label>
                    <select name="ingredients[{{ $i }}][name]" id="ingredients">
                        @foreach ($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="quantity">Quantity:</label>
                    <input type="text" id="quantity" name="ingredients[{{ $i }}][quantity]">
                </div>
                <div>
                    <label for="description">Description:</label>
                    <textarea id="quantity" name="ingredients[{{ $i }}][description]"></textarea>
                </div>
            @endfor
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
