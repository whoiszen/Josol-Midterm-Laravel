<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('products.index') }}" class="text-xl font-bold text-gray-900">
                            MyShop
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Add Product
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Success Message -->
            @if ($message = Session::get('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                    {{ $message }}
                </div>
            @endif

            <!-- Products Table -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900">Products</h2>
                </div>

                @if ($products->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-100 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Name</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">SKU</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Price</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Stock</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $product->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $product->sku }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">${{ number_format($product->price, 2) }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $product->stock }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm space-x-2">
                                            <a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                                View
                                            </a>
                                            <a href="{{ route('products.edit', $product) }}" class="text-amber-600 hover:text-amber-900 font-medium">
                                                Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium" onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="p-12 text-center">
                        <p class="text-gray-500 text-lg mb-4">No products found</p>
                        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Create First Product
                        </a>
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>
