<x-customer-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-6">Profile Settings</h2>

                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium">Basic Information</h3>
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" 
                                       value="{{ old('name', $user->name) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" 
                                       value="{{ old('email', $user->email) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="text" name="phone" id="phone" 
                                       value="{{ old('phone', $user->phone) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Active Address -->
                            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                                <div class="flex justify-between items-start mb-3">
                                    <h4 class="text-sm font-medium text-gray-700">Active Address</h4>
                                    <a href="{{ route('customer.addresses.index') }}" 
                                       class="text-sm text-[#0f172a] hover:underline">
                                        Manage Addresses
                                    </a>
                                </div>
                                
                                @if($user->addresses()->where('is_primary', true)->first())
                                    @php
                                        $primaryAddress = $user->addresses()->where('is_primary', true)->first();
                                    @endphp
                                    <div class="space-y-1">
                                        <div class="text-sm font-medium text-gray-800">
                                            {{ $primaryAddress->recipient_name }}
                                            @if($primaryAddress->label)
                                                <span class="text-gray-500">({{ $primaryAddress->label }})</span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-600">{{ $primaryAddress->phone_number }}</div>
                                        <div class="text-sm text-gray-600">
                                            {{ $primaryAddress->address }},
                                            {{ $primaryAddress->city }},
                                            {{ $primaryAddress->postal_code }}
                                        </div>
                                    </div>
                                @else
                                    <div class="text-sm text-gray-500 italic">
                                        No primary address set. 
                                        <a href="{{ route('customer.addresses.create') }}" 
                                           class="text-[#0f172a] hover:underline">
                                            Add an address
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Change Password -->
                        <div class="space-y-4 pt-6 border-t">
                            <h3 class="text-lg font-medium">Change Password</h3>
                            
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                                <input type="password" name="current_password" id="current_password" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                                <input type="password" name="new_password" id="new_password" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('new_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="flex justify-end pt-6">
                            <button type="submit" 
                                    class="bg-gradient-to-r from-[#0f172a] to-[#334155] text-white py-2 px-4 rounded-lg hover:opacity-90">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-customer-layout> 