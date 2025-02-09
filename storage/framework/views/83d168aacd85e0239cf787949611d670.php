<nav x-data="{ open: false }" id="mainNav" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
    <div class="nav-container bg-gradient-to-r from-indigo-700 to-purple-700 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo dan Search Bar -->
                <div class="flex-1 flex items-center space-x-8">
                    <!-- Logo -->
                    <a href="<?php echo e(route('customer.index')); ?>" class="flex-shrink-0 flex items-center space-x-2">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <h1 class="text-2xl font-bold text-white">RobbStark Shop</h1>
                    </a>

                    <!-- Search Bar -->
                    <div class="hidden md:block flex-1 max-w-lg">
                        <div class="relative">
                            <input type="text" placeholder="Search products..."
                                class="w-full bg-white/10 border border-white/20 rounded-lg pl-10 pr-4 py-2 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50">
                            <div class="absolute left-3 top-2.5">
                                <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-6">
                    <!-- Categories Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-white hover:text-gray-200 transition-colors">
                            <span>Categories</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block">
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-indigo-50">T-Shirts</a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-indigo-50">Hoodies</a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-indigo-50">Pants</a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-indigo-50">Jackets</a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-indigo-50">Jeans</a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-indigo-50">Sweaters</a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-indigo-50">Shorts</a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-indigo-50">Accessories</a>
                        </div>
                    </div>

                    <!-- Wishlist -->
                    <a href="<?php echo e(route('customer.wishlist')); ?>" class="relative group">
                        <svg class="w-6 h-6 text-white group-hover:text-gray-200 transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            <span class="wishlist-counter">0</span>
                        </span>
                    </a>

                    <!-- Cart -->
                    <a href="<?php echo e(route('customer.cart')); ?>" class="relative group">
                        <svg class="w-6 h-6 text-white group-hover:text-gray-200 transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            <span class="cart-counter">0</span>
                        </span>
                    </a>

                    <!-- User Menu -->
                    <?php if(auth()->guard()->check()): ?>
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-white hover:text-gray-200 transition-colors">
                                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name)); ?>&background=random"
                                    alt="Profile" class="w-8 h-8 rounded-full">
                                <span><?php echo e(auth()->user()->name); ?></span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu dengan animasi hover yang ditingkatkan -->
                            <div class="absolute right-0 w-48 py-2 mt-1 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out"
                                style="transform-origin: top right; transform: scale(0.95);">

                                <!-- Profile Settings -->
                                <a href="<?php echo e(route('customer.profile')); ?>"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-50 transition-all duration-200 hover:pl-6 group/item">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 transition-colors duration-200 group-hover/item:text-[#0f172a]"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span
                                            class="transition-colors duration-200 group-hover/item:text-[#0f172a]">Profile
                                            Settings</span>
                                        <span
                                            class="ml-auto opacity-0 group-hover/item:opacity-100 transition-opacity duration-200">→</span>
                                    </div>
                                </a>

                                <!-- Divider -->
                                <div class="my-1 border-t border-gray-100"></div>


                                <!-- Logout Button -->
                                <button type="button" onclick="confirmLogout()"
                                    class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition-all duration-200 hover:pl-6 group/item">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 transition-colors duration-200 group-hover/item:text-red-700"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span
                                            class="transition-colors duration-200 group-hover/item:text-red-700">Logout</span>
                                        <span
                                            class="ml-auto opacity-0 group-hover/item:opacity-100 transition-opacity duration-200">→</span>
                                    </div>
                                </button>

                                <!-- Hidden Logout Form -->
                                <form id="logout-form" method="POST" action="<?php echo e(route('logout')); ?>" class="hidden">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Search (visible on mobile only) -->
    <div class="md:hidden bg-indigo-800 px-4 py-3">
        <div class="relative">
            <input type="text" placeholder="Search products..."
                class="w-full bg-white/10 border border-white/20 rounded-lg pl-10 pr-4 py-2 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50">
            <div class="absolute left-3 top-2.5">
                <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>
</nav>
</
<?php /**PATH C:\laragon\www\uas_pti\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>