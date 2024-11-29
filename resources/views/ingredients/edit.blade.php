@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>
    <form action="{{ route('ingredients.update', $ingredient) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Ingredient Name:</label>
            <input type="text" id="name" name="name" value="{{ $ingredient->name }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
