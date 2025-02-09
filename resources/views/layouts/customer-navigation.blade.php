@php
    use App\Services\CartService;
@endphp

<nav class="fixed top-0 left-0 right-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 bg-300% animate-gradient shadow-lg z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('customer.index') }}" class="group flex items-center space-x-3">
                        <svg class="w-8 h-8 text-white transform transition-transform group-hover:scale-110 group-hover:rotate-6" 
                             fill="none" 
                             stroke="currentColor" 
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2" 
                                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span class="text-xl font-bold text-white hover:text-gray-100 transition-all duration-300 ease-in-out transform group-hover:scale-105">
                            RobbStark
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('customer.index')" :active="request()->routeIs('customer.index')" 
                               class="text-white hover:text-gray-100 relative group">
                        <span class="flex items-center transition-transform duration-300 group-hover:transform group-hover:translate-x-1">
                            <i class="fas fa-home mr-2 transition-transform duration-300 group-hover:scale-110"></i>
                            <span>Dashboard</span>
                        </span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                    </x-nav-link>
                    
                    <x-nav-link :href="route('customer.orders')" :active="request()->routeIs('customer.orders')"
                               class="text-white hover:text-gray-100 relative group">
                        <span class="flex items-center transition-transform duration-300 group-hover:transform group-hover:translate-x-1">
                            <i class="fas fa-shopping-bag mr-2 transition-transform duration-300 group-hover:scale-110"></i>
                            <span>My Orders</span>
                        </span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                    </x-nav-link>
                    
                    <x-nav-link :href="route('customer.cart')" :active="request()->routeIs('customer.cart')"
                               class="text-white hover:text-gray-100 relative group">
                        <span class="flex items-center transition-transform duration-300 group-hover:transform group-hover:translate-x-1">
                            <i class="fas fa-shopping-cart mr-2 transition-transform duration-300 group-hover:scale-110 animate-wiggle"></i>
                            <span>Cart</span>
                            <span class="ml-2 bg-white text-blue-600 py-0.5 px-2 rounded-full text-xs font-semibold transform transition-transform duration-300 group-hover:scale-110 hover:rotate-12">
                                {{ CartService::getCount() }}
                            </span>
                        </span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></span>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-white hover:text-gray-100 focus:outline-none transition-all duration-300 ease-in-out group">
                            <div class="transform transition-transform duration-300 group-hover:scale-105">{{ Auth::user()->name }}</div>
                            <div class="ml-1 transform transition-transform duration-300 group-hover:rotate-180">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white rounded-md shadow-lg transform transition-all duration-300">
                            <x-dropdown-link :href="route('customer.profile')" 
                                           class="hover:bg-gray-50 transition-colors duration-300 group">
                                <span class="flex items-center transition-transform duration-300 group-hover:translate-x-1">
                                    <i class="fas fa-user mr-2 text-blue-600 transition-transform duration-300 group-hover:scale-110"></i>
                                    Profile
                                </span>
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="hover:bg-gray-50 transition-colors duration-300 group">
                                    <span class="flex items-center transition-transform duration-300 group-hover:translate-x-1">
                                        <i class="fas fa-sign-out-alt mr-2 text-blue-600 transition-transform duration-300 group-hover:scale-110"></i>
                                        Log Out
                                    </span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-100 hover:bg-blue-700 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 bg-white">
            <x-responsive-nav-link :href="route('customer.index')" :active="request()->routeIs('customer.index')"
                                 class="hover:bg-gray-50">
                <i class="fas fa-home mr-2 text-blue-600"></i> Dashboard
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('customer.orders')" :active="request()->routeIs('customer.orders')"
                                 class="hover:bg-gray-50">
                <i class="fas fa-shopping-bag mr-2 text-blue-600"></i> My Orders
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('customer.cart')" :active="request()->routeIs('customer.cart')"
                                 class="hover:bg-gray-50">
                <i class="fas fa-shopping-cart mr-2 text-blue-600"></i> Cart ({{ CartService::getCount() }})
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 bg-white">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('customer.profile')" class="hover:bg-gray-50">
                    <i class="fas fa-user mr-2 text-blue-600"></i> Profile
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="hover:bg-gray-50">
                        <i class="fas fa-sign-out-alt mr-2 text-blue-600"></i> Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer to prevent content from hiding under fixed navbar -->
<div class="h-16"></div>

<style>
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .animate-gradient {
        animation: gradient 15s ease infinite;
    }

    @keyframes wiggle {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(-10deg); }
        75% { transform: rotate(10deg); }
    }

    .animate-wiggle {
        animation: wiggle 1s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .bg-300\% {
        background-size: 300% 300%;
    }

    /* Hover Effects */
    .nav-link-hover {
        position: relative;
        overflow: hidden;
    }

    .nav-link-hover::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: white;
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s ease;
    }

    .nav-link-hover:hover::after {
        transform: scaleX(1);
        transform-origin: left;
    }
</style>