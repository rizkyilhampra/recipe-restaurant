@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" value="{{ $category->name }}" required>
        </div>
        <div class="">
            <label for="description">Description:</label>
            <textarea name="description" id="description">{{ $category->description }}</textarea>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
