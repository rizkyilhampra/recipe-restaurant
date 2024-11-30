@extends('layouts.app')

@section('content')
    <h1>Recipes</h1>

    <a href="{{ route('recipes.create') }}">Create Recipe</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipes as $recipe)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $recipe->name }}</td>
                    <td>
                        <a href="{{ route('recipes.show', $recipe) }}">View</a>
                        <a href="{{ route('recipes.edit', $recipe) }}">Edit</a>
                        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" style="display:inline;">
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
