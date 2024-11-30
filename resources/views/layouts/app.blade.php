<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .nav {
            margin-bottom: 20px;
        }

        .nav a {
            margin-right: 10px;
            text-decoration: none;
            color: blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        button {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="nav">
            <a href="{{ route('recipes.index') }}">Recipe</a>
            <a href="{{ route('categories.index') }}">Category</a>
            <a href="{{ route('ingredients.index') }}">Ingredient</a>
        </div>
        @yield('content')
    </div>
</body>

</html>
