<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold font-poppins">Edit Product</h2>
                <p class="text-gray-600">Update product information</p>
            </div>
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                Back to Products
            </a>
        </div>

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price (Rp)</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">Rp</span>
                        </div>
                        <input type="number" name="price" id="price" 
                               class="pl-12 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               value="{{ old('price', $product->price) }}" required>
                    </div>
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category" id="category" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="">Select a category</option>
                        @foreach(['T-Shirts', 'Shirts', 'Pants', 'Jeans', 'Dresses', 'Skirts', 'Jackets & Coats', 'Sweaters & Hoodies', 'Activewear', 'Underwear', 'Accessories'] as $category)
                            <option value="{{ $category }}" {{ old('category', $product->category) == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                    <input type="text" name="size" id="size" value="{{ old('size', $product->size) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                    <input type="text" name="color" id="color" value="{{ old('color', $product->color) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="material" class="block text-sm font-medium text-gray-700">Material</label>
                    <input type="text" name="material" id="material" value="{{ old('material', $product->material) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>

            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                <input type="text" name="brand" id="brand" value="{{ old('brand', $product->brand) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Current Image</label>
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="mt-2 h-32 w-auto" id="currentImage">
                    <p class="text-xs text-gray-500 mt-1">Current path: {{ $product->image }}</p>
                @else
                    <p class="mt-2 text-sm text-gray-500">No image uploaded</p>
                @endif
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Update Image</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative"
                     id="drop-zone"
                     ondrop="dropHandler(event)"
                     ondragover="dragOverHandler(event)"
                     ondragleave="dragLeaveHandler(event)">
                    <div class="space-y-1 text-center">
                        <img id="preview" src="#" alt="Preview" class="mx-auto h-32 w-auto hidden mb-4">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" 
                                  stroke-width="2" 
                                  stroke-linecap="round" 
                                  stroke-linejoin="round"/>
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                <span>Upload a file</span>
                                <input id="image" 
                                       name="image" 
                                       type="file" 
                                       class="sr-only" 
                                       accept="image/*"
                                       onchange="handleFiles(this.files)">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
                    Update Product
                </button>
            </div>
        </form>
    </div>

    <script>
        function handleFiles(files) {
            const preview = document.getElementById('preview');
            const dropZone = document.getElementById('drop-zone');
            const file = files[0];

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    dropZone.classList.add('border-indigo-500');
                    dropZone.classList.remove('border-gray-300');
                }
                
                reader.readAsDataURL(file);
            }
        }

        function dragOverHandler(event) {
            event.preventDefault();
            const dropZone = document.getElementById('drop-zone');
            dropZone.classList.add('border-indigo-500', 'bg-indigo-50');
            dropZone.classList.remove('border-gray-300');
        }

        function dragLeaveHandler(event) {
            event.preventDefault();
            const dropZone = document.getElementById('drop-zone');
            dropZone.classList.remove('border-indigo-500', 'bg-indigo-50');
            dropZone.classList.add('border-gray-300');
        }

        function dropHandler(event) {
            event.preventDefault();
            
            const dropZone = document.getElementById('drop-zone');
            dropZone.classList.remove('border-indigo-500', 'bg-indigo-50');
            dropZone.classList.add('border-gray-300');

            const dt = event.dataTransfer;
            const files = dt.files;

            document.getElementById('image').files = files;
            handleFiles(files);
        }
    </script>
</x-app-layout> 