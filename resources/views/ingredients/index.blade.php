@extends('layouts.app')

@section('content')
    <h1>Ingredients</h1>

    <a href="{{ route('ingredients.create') }}">Create Ingredient</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingredients as $ingredient)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ingredient->name }}</td>
                    <td>
                        <a href="{{ route('ingredients.show', $ingredient) }}">View</a>
                        <a href="{{ route('ingredients.edit', $ingredient) }}">Edit</a>
                        <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
