<x-customer-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-6">Edit Address</h2>

                    <form action="{{ route('customer.addresses.update', $address) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        @include('customer.addresses._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-customer-layout> 