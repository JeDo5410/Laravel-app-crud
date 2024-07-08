<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .edit-link, .delete-button, .create-button {
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .edit-link:hover, .delete-button:hover, .create-button:hover {
            background-color: #2980b9;
        }
        .delete-button {
            background-color: #e74c3c;
        }
        .delete-button:hover {
            background-color: #c0392b;
        }
        .create-button {
            background-color: #2ecc71;
            margin-bottom: 20px;
        }
        .create-button:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <h1>Product List</h1>
    @if (session()->has('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('product.create') }}" class="create-button">Create New Product</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="{{ route('product.edit', ['product' => $product]) }}" class="edit-link">Edit</a>
                        <form method="post" action="{{ route('product.destroy', ['product' => $product]) }}" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>