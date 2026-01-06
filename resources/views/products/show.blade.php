<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} - {{ config('app.name', 'Laravel') }}</title>
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
            <!-- Success Message -->
            @if ($message = Session::get('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                    {{ $message }}
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h2>
                        <p class="text-gray-600 mt-1">SKU: {{ $product->sku }}</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">
                            Edit
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition" onclick="return confirm('Are you sure you want to delete this product?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="grid grid-cols-2 gap-6 py-6 border-t border-b border-gray-200">
                    <!-- Price -->
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-2">Price</p>
                        <p class="text-2xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>
                    </div>

                    <!-- Stock -->
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-2">Stock</p>
                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->stock }} {{ $product->stock == 1 ? 'unit' : 'units' }}
                        </span>
                    </div>
                </div>

                <!-- Description -->
                @if ($product->description)
                    <div class="py-6">
                        <p class="text-sm font-medium text-gray-600 mb-2">Description</p>
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $product->description }}</p>
                    </div>
                @endif

                <!-- Timestamps -->
                <div class="py-6 border-t border-gray-200 text-sm text-gray-500">
                    <p>Created: {{ $product->created_at->format('M d, Y H:i') }}</p>
                    <p>Updated: {{ $product->updated_at->format('M d, Y H:i') }}</p>
                </div>

                <!-- Back Button -->
                <div class="pt-6 border-t border-gray-200">
                    <div class="flex justify-between">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-2 border border-gray-300 text-gray-900 rounded-lg hover:bg-gray-50 transition">
                            Back to Products
                        </a>
                        <form action="{{url('/products/mail-info')}}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Send to Customers
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
