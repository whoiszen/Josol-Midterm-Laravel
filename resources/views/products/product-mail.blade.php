<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Product Info</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Inline styles for email compatibility */
        body {
            background-color: #f9fafb;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 24px;
            color: #111827;
            margin: 0;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 18px;
            color: #111827;
            margin-bottom: 10px;
        }
        .section p {
            font-size: 14px;
            color: #374151;
            line-height: 1.5;
        }
        .footer {
            border-top: 1px solid #e5e7eb;
            margin-top: 20px;
            padding-top: 10px;
            font-size: 12px;
            color: #6b7280;
        }
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">

        <!-- Main Content -->
        <main class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">


            <div class="bg-white shadow-md rounded-lg p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h2>
                        <p class="text-gray-600 mt-1">SKU: {{ $product->sku }}</p>
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
            </div>
        </main>
    </div>
</body>
</html>
