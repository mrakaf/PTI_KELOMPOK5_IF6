<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Edit Product</h2>
                        <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Products
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('stock')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category" id="category" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Category</option>
                                <option value="T-Shirts" {{ old('category', $product->category) == 'T-Shirts' ? 'selected' : '' }}>T-Shirts</option>
                                <option value="Jackets & Coats" {{ old('category', $product->category) == 'Jackets & Coats' ? 'selected' : '' }}>Jackets & Coats</option>
                                <option value="Activewear" {{ old('category', $product->category) == 'Activewear' ? 'selected' : '' }}>Activewear</option>
                                <option value="Dresses" {{ old('category', $product->category) == 'Dresses' ? 'selected' : '' }}>Dresses</option>
                                <option value="Pants" {{ old('category', $product->category) == 'Pants' ? 'selected' : '' }}>Pants</option>
                                <option value="Jeans" {{ old('category', $product->category) == 'Jeans' ? 'selected' : '' }}>Jeans</option>
                                <option value="Shorts" {{ old('category', $product->category) == 'Shorts' ? 'selected' : '' }}>Shorts</option>
                                <option value="Skirts" {{ old('category', $product->category) == 'Skirts' ? 'selected' : '' }}>Skirts</option>
                                <option value="Sweaters" {{ old('category', $product->category) == 'Sweaters' ? 'selected' : '' }}>Sweaters</option>
                                <option value="Hoodies" {{ old('category', $product->category) == 'Hoodies' ? 'selected' : '' }}>Hoodies</option>
                                <option value="Formal Wear" {{ old('category', $product->category) == 'Formal Wear' ? 'selected' : '' }}>Formal Wear</option>
                                <option value="Accessories" {{ old('category', $product->category) == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-data="imageUpload()" class="mt-1">
                            <label class="block text-sm font-medium text-gray-700">Product Image</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md"
                                 :class="{'border-indigo-500': isDragging}"
                                 @dragover.prevent="isDragging = true"
                                 @dragleave.prevent="isDragging = false"
                                 @drop.prevent="handleDrop($event)">
                                
                                <div class="space-y-1 text-center">
                                    <div class="flex flex-col items-center">
                                        @if($product->image)
                                            <img src="{{ Storage::url($product->image) }}" class="h-32 w-auto mb-4" alt="Current Image">
                                        @endif
                                        <template x-if="imageUrl">
                                            <img :src="imageUrl" class="h-32 w-auto" />
                                        </template>
                                    </div>
                                    <div class="flex text-sm text-gray-600">
                                        <label class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                            <span>Upload a new file</span>
                                            <input type="file" name="image" class="sr-only" accept="image/*" @change="handleFileSelect">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function imageUpload() {
            return {
                isDragging: false,
                imageUrl: null,
                handleFileSelect(e) {
                    const file = e.target.files[0];
                    this.showPreview(file);
                },
                handleDrop(e) {
                    this.isDragging = false;
                    const file = e.dataTransfer.files[0];
                    this.showPreview(file);
                    
                    // Update the file input
                    const input = this.$el.querySelector('input[type="file"]');
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    input.files = dataTransfer.files;
                },
                showPreview(file) {
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = e => this.imageUrl = e.target.result;
                        reader.readAsDataURL(file);
                    }
                }
            }
        }
    </script>
    @endpush
</x-app-layout> 