@extends('layouts.admin')

@section('content')
    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-xl">
        <div class="p-6">
            <div class="flex justify-between items-center mb-8">
                <h2
                    class="text-2xl font-poppins font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Product Management
                </h2>
                <a href="{{ route('admin.products.create') }}"
                    class="group relative inline-flex items-center px-6 py-3 overflow-hidden text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-md hover:shadow-lg">
                    <span
                        class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                    <svg class="w-5 h-5 mr-2 transition-transform duration-300 transform group-hover:scale-110"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span class="font-poppins">Add New Product</span>
                </a>
            </div>

            <div class="mb-6">
                <form action="{{ route('admin.products.index') }}" method="GET" class="flex gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by name or description..."
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="w-48">
                        <select name="category"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}"
                                    {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-48">
                        <select name="sort"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Sort By</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)
                            </option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)
                            </option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price
                                (Low-High)</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price
                                (High-Low)</option>
                            <option value="stock_asc" {{ request('sort') == 'stock_asc' ? 'selected' : '' }}>Stock
                                (Low-High)</option>
                            <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>Stock
                                (High-Low)</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Search
                    </button>
                    @if (request()->hasAny(['search', 'category', 'sort']))
                        <a href="{{ route('admin.products.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-50 to-purple-50">
                            <th
                                class="px-6 py-4 text-left text-xs font-poppins font-semibold text-gray-600 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-poppins font-semibold text-gray-600 uppercase tracking-wider">
                                Category</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-poppins font-semibold text-gray-600 uppercase tracking-wider">
                                Price</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-poppins font-semibold text-gray-600 uppercase tracking-wider">
                                Stock</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-poppins font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-poppins font-semibold text-gray-600 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors duration-200" id="product-{{ $product->id }}">
                                <td class="px-6 py-4 whitespace-nowrap font-poppins">
                                    <div class="flex items-center">

                                        @if ($product->image)
                                            <img class="h-10 w-10 rounded-lg object-cover mr-3"
                                                src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                                        @else
                                            <div
                                                class="h-10 w-10 rounded-lg bg-gray-200 mr-3 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="font-medium text-gray-900">{{ $product->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $product->category ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-poppins">
                                    <span class="text-indigo-600 font-semibold">{{ $product->formatted_price }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-poppins">
                                    <span
                                        class="px-3 py-1 rounded-full text-sm {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-poppins">
                                    <span
                                        class="px-3 py-1 rounded-full text-sm {{ $product->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-poppins">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200 flex items-center group">
                                            <svg class="w-4 h-4 mr-1 transform group-hover:scale-110 transition-transform duration-200"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span class="group-hover:underline">Edit</span>
                                        </a>
                                        <button
                                            class="delete-product text-red-600 hover:text-red-900 transition-colors duration-200 flex items-center group"
                                            data-product-id="{{ $product->id }}">
                                            <svg class="w-4 h-4 mr-1 transform group-hover:scale-110 transition-transform duration-200"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <span class="group-hover:underline">Delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
        <script>
            function confirmDelete(productId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4F46E5',
                    cancelButtonColor: '#EF4444',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    background: '#ffffff',
                    borderRadius: '1rem',
                    customClass: {
                        title: 'font-poppins text-gray-800',
                        content: 'font-inter text-gray-600',
                        confirmButton: 'font-poppins',
                        cancelButton: 'font-poppins'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const row = document.querySelector(`tr[id="product-${productId}"]`);
                        if (row) {
                            row.classList.add('opacity-0', 'transform', 'scale-95');
                            setTimeout(() => row.remove(), 300);
                        }

                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Product has been deleted successfully.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false,
                            background: '#ffffff',
                            borderRadius: '1rem',
                            customClass: {
                                title: 'font-poppins text-gray-800',
                                content: 'font-inter text-gray-600'
                            }
                        });

                        const formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('_method', 'DELETE');

                        fetch(`/admin/products/${productId}`, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'Accept': 'application/json'
                            }
                        });
                    }
                });
            }

            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.delete-product');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const productId = this.getAttribute('data-product-id');
                        confirmDelete(productId);
                    });
                });
            });
        </script>
    @endpush
@endsection
