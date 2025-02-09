<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RobbStark Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold">RobbStark Shop</h1>
                </div>
                <div class="flex items-center space-x-8">
                    <a href="#" class="text-gray-700 hover:text-gray-900">Home</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Products</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Categories</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-gray-900">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600">
        <div class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 text-white">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">Discover Your Style</h2>
                    <p class="text-xl mb-8">Find the perfect outfit that matches your personality.</p>
                    <a href="#categories" class="inline-block px-8 py-3 bg-white text-blue-600 rounded-full font-semibold hover:bg-gray-100 transition-colors">
                        Shop Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div id="categories" class="max-w-7xl mx-auto py-16 px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Shop by Category</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Men's Fashion -->
            <div class="group relative overflow-hidden rounded-lg shadow-lg">
                <img src="images/categories/men.jpg" alt="Men's Fashion" class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-white">
                    <h3 class="text-2xl font-bold mb-4">Men's Fashion</h3>
                    <a href="#" class="px-6 py-2 bg-white text-black rounded-full hover:bg-gray-100">Browse Collection</a>
                </div>
            </div>

            <!-- Stylish T-Shirt -->
            <div class="group relative overflow-hidden rounded-lg shadow-lg">
                <img src="images/categories/zipper.jpg" alt="Stylish T-Shirt" class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-white">
                    <h3 class="text-2xl font-bold mb-4">Stylish T-Shirt</h3>
                    <a href="#" class="px-6 py-2 bg-white text-black rounded-full hover:bg-gray-100">Browse Collection</a>
                </div>
            </div>

            <!-- Accessories -->
            <div class="group relative overflow-hidden rounded-lg shadow-lg">
                <img src="images/categories/gelang.jpg" alt="Accessories" class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-white">
                    <h3 class="text-2xl font-bold mb-4">Accessories</h3>
                    <a href="#" class="px-6 py-2 bg-white text-black rounded-full hover:bg-gray-100">Browse Collection</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} RobbStark Shop. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
