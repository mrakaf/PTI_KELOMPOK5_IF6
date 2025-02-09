<x-customer-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">My Orders</h2>

                    @if ($orders && $orders->isEmpty())
                        <div class="text-center py-8 border rounded-lg bg-gray-50">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h1l1 2h13l1-2h1m-1 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6m16 0H3"></path>
                            </svg>
                            <div class="text-gray-500 mb-3">No orders found</div>
                        </div>
                    @elseif ($orders)
                        <div class="grid gap-4 sm:grid-cols-2">
                            @foreach ($orders as $order)
                                <div class="border rounded-lg p-4 hover:border-[#0f172a] transition-all duration-300">
                                    <div class="font-medium text-gray-800 mb-2">Order #{{ $order->order_number }}</div>
                                    <div class="text-sm text-gray-600 mb-2">Total: Rp
                                        {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                    <div class="text-sm text-gray-600 mb-2">Status: {{ ucfirst($order->status) }}</div>
                                    <div class="text-sm text-gray-600 mb-2">Payment Status:
                                        {{ ucfirst($order->payment_status) }}</div>
                                    <div class="text-sm text-gray-600 mb-2">Items:</div>
                                    <ul class="list-disc list-inside text-sm text-gray-600">
                                        @if ($order->orderItems)
                                            @foreach ($order->orderItems as $item)
                                                <li>{{ $item->product->name }} ({{ $item->quantity }} x Rp
                                                    {{ number_format($item->price, 0, ',', '.') }})</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>
