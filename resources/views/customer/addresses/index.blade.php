<x-customer-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">My Addresses</h2>
                        <a href="{{ route('customer.addresses.create') }}" 
                           class="bg-gradient-to-r from-[#0f172a] to-[#334155] text-white px-4 py-2 rounded-lg hover:opacity-90">
                            Add New Address
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid md:grid-cols-2 gap-6">
                        @forelse ($addresses as $address)
                            <div class="border rounded-lg p-4 relative {{ $address->is_primary ? 'border-[#0f172a]' : 'border-gray-200' }}">
                                @if ($address->is_primary)
                                    <span class="absolute top-2 right-2 bg-[#0f172a] text-white text-xs px-2 py-1 rounded">
                                        Primary
                                    </span>
                                @endif
                                
                                <div class="mb-2">
                                    <span class="text-sm text-gray-500">{{ $address->label ?: 'Unlabeled Address' }}</span>
                                </div>
                                
                                <div class="space-y-1">
                                    <p class="font-medium">{{ $address->recipient_name }}</p>
                                    <p class="text-sm">{{ $address->phone_number }}</p>
                                    <p class="text-sm">{{ $address->address }}</p>
                                    <p class="text-sm">{{ $address->city }}, {{ $address->postal_code }}</p>
                                </div>

                                <div class="mt-4 flex justify-end space-x-2">
                                    @if (!$address->is_primary)
                                        <form action="{{ route('customer.addresses.primary', $address) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-sm text-blue-600 hover:underline">
                                                Set as Primary
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('customer.addresses.edit', $address) }}" 
                                       class="text-sm text-gray-600 hover:underline">
                                        Edit
                                    </a>

                                    <form action="{{ route('customer.addresses.destroy', $address) }}" 
                                          method="POST" 
                                          class="delete-address-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                onclick="confirmDelete(this)" 
                                                class="text-sm text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-12 text-gray-500">
                                No addresses found. Add your first address!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>

<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Delete Address?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0f172a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleting...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });
                button.closest('form').submit();
            }
        });
    }

    // Show success message if redirected after delete
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            timer: 1500,
            showConfirmButton: false
        });
    @endif
</script> 