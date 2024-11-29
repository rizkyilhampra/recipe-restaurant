@extends('layouts.app')

@section('content')
    <h1>Category Details</h1>
    <p><strong>ID:</strong> {{ $category->id }}</p>
    <p><strong>Name:</strong> {{ $category->name }}</p>
    <p><strong>Description:</strong> {{ $category->description }}</p>
    <p><strong>Recipes:</strong>
        <li>
            @foreach ($category->recipes as $recipe)
                <a href="{{ route('recipes.show', $recipe) }}">{{ $recipe->name }}</a>
            @endforeach
        </li>
    </p>

    <a href="{{ route('categories.index') }}">Back to List</a>
@endsection
