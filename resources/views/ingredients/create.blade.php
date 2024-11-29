@extends('layouts.app')

@section('content')
    <h1>Create Ingredient</h1>
    <form action="{{ route('ingredients.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Ingredient Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
