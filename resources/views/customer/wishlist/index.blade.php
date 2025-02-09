<x-customer-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-6">My Wishlist</h2>

                    @if($wishlists->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($wishlists as $wishlist)
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $wishlist->product->image) }}" 
                                             alt="{{ $wishlist->product->name }}" 
                                             class="w-full h-64 object-cover">
                                        
                                        <button onclick="removeFromWishlist({{ $wishlist->id }})" 
                                                class="absolute top-4 right-4 p-2 bg-white/90 rounded-lg text-red-500 hover:bg-white transition-colors duration-300">
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="p-6">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $wishlist->product->name }}</h3>
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $wishlist->product->description }}</p>
                                        
                                        <div class="flex justify-between items-center mb-4">
                                            <span class="text-xl font-bold text-gray-900">
                                                Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                Stock: {{ $wishlist->product->stock }}
                                            </span>
                                        </div>

                                        <button onclick="addToCart({{ $wishlist->product->id }})" 
                                                class="w-full bg-gradient-to-r from-[#0f172a] to-[#334155] text-white py-3 px-4 rounded-xl hover:opacity-90 transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            Move to Cart
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No items in wishlist</h3>
                            <p class="mt-1 text-sm text-gray-500">Start adding some items to your wishlist!</p>
                            <div class="mt-6">
                                <a href="{{ route('customer.index') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-[#0f172a] to-[#334155] hover:opacity-90">
                                    Browse Products
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    function removeFromWishlist(wishlistId) {
        if (confirm('Are you sure you want to remove this item from your wishlist?')) {
            fetch(`/customer/wishlist/remove/${wishlistId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const wishlistItem = document.querySelector(`[data-wishlist-id="${wishlistId}"]`);
                    wishlistItem.remove();
                    
                    const counter = document.querySelector('.wishlist-counter');
                    if (counter) {
                        counter.textContent = parseInt(counter.textContent) - 1;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Item removed from wishlist',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    if (document.querySelectorAll('.wishlist-item').length === 0) {
                        location.reload();
                    }
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            });
        }
    }
    </script>
    @endpush
</x-customer-layout> 