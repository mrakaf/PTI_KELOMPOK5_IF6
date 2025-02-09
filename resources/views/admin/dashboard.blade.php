<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - RobbStark</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body class="bg-gray-50" x-data="{ sidebarOpen: true }">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-blue-600 to-blue-800 transform transition-transform duration-300"
         :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
        <!-- Logo -->
        <div class="flex items-center justify-between h-16 px-4 bg-blue-700/50 backdrop-blur-sm">
            <div class="flex items-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="ml-2 text-xl font-semibold text-white">RobbStark</span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="px-4 mt-8 space-y-2">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-4 py-3 rounded-lg group transition-colors
                      {{ request()->routeIs('admin.dashboard') 
                         ? 'text-white bg-white/10' 
                         : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                <i class="fas fa-home w-5 h-5"></i>
                <span class="ml-3">Dashboard</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-white/70 rounded-lg group hover:bg-white/10 hover:text-white transition-colors">
                <i class="fas fa-box w-5 h-5"></i>
                <span class="ml-3">Products</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-white/70 rounded-lg group hover:bg-white/10 hover:text-white transition-colors">
                <i class="fas fa-users w-5 h-5"></i>
                <span class="ml-3">Users</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-white/70 rounded-lg group hover:bg-white/10 hover:text-white transition-colors">
                <i class="fas fa-shopping-cart w-5 h-5"></i>
                <span class="ml-3">Orders</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-white/70 rounded-lg group hover:bg-white/10 hover:text-white transition-colors">
                <i class="fas fa-chart-bar w-5 h-5"></i>
                <span class="ml-3">Analytics</span>
            </a>
        </nav>

        <!-- Bottom Section -->
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <form action="{{ route('logout') }}" 
                  method="POST" 
                  onsubmit="return confirm('Are you sure you want to logout?')">
                @csrf
                <button type="submit" 
                        class="flex items-center w-full px-4 py-3 text-white/70 rounded-lg hover:bg-white/10 hover:text-white transition-colors">
                    <i class="fas fa-sign-out-alt w-5 h-5"></i>
                    <span class="ml-3">Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 min-h-screen" :class="{'ml-64': sidebarOpen, 'ml-0': !sidebarOpen}">
        <!-- Top Bar -->
        <div class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-gray-200">
            <div class="flex items-center justify-between h-16 px-6">
                <button @click="sidebarOpen = !sidebarOpen" 
                        class="text-gray-600 hover:text-gray-900 transition-colors duration-200"
                        :class="{ 'opacity-50': sidebarOpen === null }">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="flex items-center">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="w-8 h-8 rounded-full">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" 
                             @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg" 
                     x-data="{ show: true }" 
                     x-show="show" 
                     x-init="setTimeout(() => show = false, 3000)">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif
            
            <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="text-gray-600">Here's what's happening with your store today.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Stat Card 1 -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-blue-100 rounded-full p-3">
                            <i class="fas fa-shopping-bag text-blue-600 text-xl"></i>
                        </div>
                        <span class="text-sm font-medium text-green-600">+12.5%</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">2,450</h3>
                    <p class="text-gray-600">Total Orders</p>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-purple-100 rounded-full p-3">
                            <i class="fas fa-users text-purple-600 text-xl"></i>
                        </div>
                        <span class="text-sm font-medium text-green-600">+5.2%</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">1,875</h3>
                    <p class="text-gray-600">Total Customers</p>
                </div>

                <!-- Stat Card 3 -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-green-100 rounded-full p-3">
                            <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                        </div>
                        <span class="text-sm font-medium text-green-600">+18.7%</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">$12,875</h3>
                    <p class="text-gray-600">Total Revenue</p>
                </div>

                <!-- Stat Card 4 -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-red-100 rounded-full p-3">
                            <i class="fas fa-box text-red-600 text-xl"></i>
                        </div>
                        <span class="text-sm font-medium text-green-600">+8.3%</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">384</h3>
                    <p class="text-gray-600">Total Products</p>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-800">Recent Orders</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#ORD-001</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=0D8ABC&color=fff" 
                                             alt="John Doe" 
                                             class="w-8 h-8 rounded-full">
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">John Doe</div>
                                            <div class="text-sm text-gray-500">john@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Blue T-Shirt</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$25.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- AOS Init -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html> 