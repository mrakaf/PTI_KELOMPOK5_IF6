<x-app-layout>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold font-poppins">Orders</h2>
                <p class="text-gray-600">Manage customer orders</p>
            </div>
        </div>

        <div class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-indigo-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-indigo-900">Total Orders</h3>
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalOrders }}</p>
                </div>
                <div class="bg-green-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-green-900">Completed</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $completedOrders }}</p>
                </div>
                <div class="bg-yellow-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-yellow-900">Pending</h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ $pendingOrders }}</p>
                </div>
                <div class="bg-red-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-red-900">Cancelled</h3>
                    <p class="text-3xl font-bold text-red-600">{{ $cancelledOrders }}</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order
                            ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Products</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium">{{ $order->id }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">{{ $order->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">
                                    @foreach ($order->items as $item)
                                        {{ $item->product->name }} ({{ $item->quantity }})<br>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium">
                                    Rp{{ number_format($order->total_amount, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">{{ $order->status }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button class="text-green-600 hover:text-green-900">Approve</button>
                                </form>
                                <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button class="text-red-600 hover:text-red-900">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
