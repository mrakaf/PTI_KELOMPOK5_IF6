<div x-show="showLoginAlert" 
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="relative bg-white rounded-lg p-8 max-w-md w-full">
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button @click="showLoginAlert = false" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Login Required</h3>
                <p class="text-sm text-gray-500 mb-6">Please login first to add items to your cart.</p>
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                        Login
                    </a>
                    <button @click="showLoginAlert = false" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition duration-300">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> 