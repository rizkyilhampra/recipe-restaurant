@extends('layouts.app')

@section('content')
    <h1>Recipe Details</h1>
    <p><strong>ID:</strong> {{ $recipe->id }}</p>
    <p><strong>Name:</strong> {{ $recipe->name }}</p>
    <p><strong>Category:</strong> {{ $recipe->category->name }}</p>
    <p><strong>Ingredients:</strong>
    <ul>
        @foreach ($recipe->ingredients as $ingredient)
            <li>{{ $ingredient->name }} - {{ $ingredient->pivot->quantity }}</li>
        @endforeach
    </ul>
    </p>

    <a href="{{ route('recipes.index') }}">Back to List</a>
@endsection
