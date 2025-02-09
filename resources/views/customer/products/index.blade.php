<x-customer-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Categories</h2>
                    <ul class="space-y-2">
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('customer.products.index', ['category' => $category->id]) }}"
                                    class="text-gray-600 hover:text-indigo-600">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:w-3/4">
                <!-- Filter dan Search Section -->
                <div class="bg-white shadow-sm mb-6 rounded-lg">
                    <div class="p-4">
                        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                            <!-- Search Bar -->
                            <div class="w-full md:w-1/3">
                                <form action="{{ route('customer.products.index') }}" method="GET" class="flex">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Search products..."
                                        class="w-full rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-r-md text-white hover:bg-indigo-700">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>

                            <!-- Sort Options -->
                            <div class="flex items-center space-x-4">
                                <label class="text-sm font-medium text-gray-700">Sort by:</label>
                                <select onchange="window.location.href=this.value"
                                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}"
                                        {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}"
                                        {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High
                                    </option>
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}"
                                        {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($products as $product)
                        <!-- Product Card -->
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                            <!-- Product Image -->
                            <div class="relative aspect-w-1 aspect-h-1 overflow-hidden">
                                <img src="{{ $product->image ? Storage::url($product->image) : asset('images/placeholder.jpg') }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300">
                                <!-- Badges -->
                                @if ($product->is_featured)
                                    <span
                                        class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                        Featured
                                    </span>
                                @endif
                                @if ($product->stock <= 0)
                                    <span
                                        class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <!-- Category -->
                                <p class="text-sm text-indigo-600 font-medium mb-1">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </p>

                                <!-- Product Name -->
                                <h3
                                    class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                                    @if ($product->slug)
                                        <a href="{{ route('customer.products.show', ['slug' => $product->slug]) }}">
                                            {{ $product->name }}
                                        </a>
                                    @else
                                        {{ $product->name }} ({{ $product->slug ?? 'No slug' }})
                                    @endif
                                </h3>

                                <!-- Price -->
                                <p class="text-xl font-bold text-gray-900 mb-4">
                                    {{ $product->formatted_price }}
                                </p>

                                <!-- Action Buttons -->
                                <div class="flex items-center justify-between">
                                    <button onclick="addToCart({{ $product->id }})"
                                        @if ($product->stock <= 0) disabled @endif
                                        class="flex-1 mr-2 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors duration-200 {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}">
                                        Add to Cart
                                    </button>
                                    <button onclick="toggleWishlist({{ $product->id }})"
                                        class="p-2 text-gray-400 hover:text-red-500 transition-colors duration-200">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what
                                you're looking for.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>

<script>
    // Add to Cart function
    function addToCart(productId) {
        // Implementasi nanti setelah kita buat shopping cart
        alert('Add to cart functionality will be implemented soon!');
    }

    // Toggle Wishlist function
    function toggleWishlist(productId) {
        // Implementasi nanti setelah kita buat wishlist
        alert('Wishlist functionality will be implemented soon!');
    }
</script>
