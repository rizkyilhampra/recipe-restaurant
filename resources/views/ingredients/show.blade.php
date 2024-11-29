@extends('layouts.app')

@section('content')
    <h1>Ingredient Details</h1>
    <p><strong>ID:</strong> {{ $ingredient->id }}</p>
    <p><strong>Name:</strong> {{ $ingredient->name }}</p>

    <a href="{{ route('ingredients.index') }}">Back to List</a>
@endsection
