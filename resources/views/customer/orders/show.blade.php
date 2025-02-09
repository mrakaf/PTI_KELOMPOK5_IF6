<x-customer-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">Order #{{ $order->order_number }}</h2>

                    <!-- Order Status -->
                    <div class="mb-8">
                        <div class="inline-flex items-center px-4 py-2 rounded-full 
                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status === 'completed') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            <span class="font-medium">{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    @if($order->status === 'pending' && $order->snap_token)
                        <div class="mb-8">
                            <button id="pay-button" 
                                    class="bg-gradient-to-r from-[#0f172a] to-[#334155] text-white px-6 py-3 rounded-lg 
                                           hover:opacity-90 transition-all duration-300">
                                Pay Now
                            </button>
                        </div>
                    @endif

                    <!-- Order Details -->
                    <div class="border rounded-lg divide-y">
                        @foreach($order->items as $item)
                            <div class="p-4 flex items-center space-x-4">
                                <img src="{{ asset('storage/' . $item->product->image) }}" 
                                     alt="{{ $item->product->name }}"
                                     class="w-16 h-16 object-cover rounded">
                                
                                <div class="flex-1">
                                    <div class="font-medium">{{ $item->product->name }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </div>
                                </div>
                                
                                <div class="font-medium">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="p-4 bg-gray-50">
                            <div class="flex justify-between font-medium">
                                <span>Total</span>
                                <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($order->status === 'pending' && $order->snap_token)
        <!-- Midtrans Script -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
        <script>
            const payButton = document.querySelector('#pay-button');
            payButton.addEventListener('click', function(e) {
                e.preventDefault();

                snap.pay('{{ $order->snap_token }}', {
                    onSuccess: function(result) {
                        window.location.href = '{{ route('customer.orders.success', $order) }}';
                    },
                    onPending: function(result) {
                        alert('Payment pending');
                    },
                    onError: function(result) {
                        alert('Payment failed');
                    },
                    onClose: function() {
                        alert('You closed the payment window');
                    }
                });
            });
        </script>
    @endif
</x-customer-layout> 