<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product - {{ config('app.name', 'Laravel') }}</title>
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
                    <div class="flex items-center">
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-900">
                            Back to Products
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit Product</h2>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <h3 class="text-sm font-semibold text-red-900 mb-2">Please correct the following errors:</h3>
                        <ul class="list-disc list-inside space-y-1 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-900 mb-2">
                            Product Name <span class="text-red-600">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-900 mb-2">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-900 mb-2">
                            Price <span class="text-red-600">*</span>
                        </label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror" required>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SKU -->
                    <div>
                        <label for="sku" class="block text-sm font-medium text-gray-900 mb-2">
                            SKU <span class="text-red-600">*</span>
                        </label>
                        <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sku') border-red-500 @enderror" required>
                        @error('sku')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-900 mb-2">
                            Stock <span class="text-red-600">*</span>
                        </label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('stock') border-red-500 @enderror" required>
                        @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 justify-end pt-4 border-t border-gray-200">
                        <a href="{{ route('products.index') }}" class="px-6 py-2 border border-gray-300 text-gray-900 rounded-lg hover:bg-gray-50 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
