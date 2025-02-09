<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <!-- Custom Styles -->
    <style>
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        .gradient-text {
            background: linear-gradient(45deg, #4F46E5, #7C3AED);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-inter antialiased">
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 bg-gradient-to-b from-indigo-700 to-purple-700 w-64 h-full">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="p-4">
                    <h1 class="font-poppins text-white text-2xl font-bold tracking-tight">
                        <span class="gradient-text bg-clip-text">RobbStark</span>
                        <span class="text-white">Shop</span>
                    </h1>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-2 py-4">
                    <a href="<?php echo e(route('dashboard')); ?>" 
                       class="flex items-center px-4 py-2 text-gray-100 rounded-lg transition-all duration-200 ease-in-out font-medium
                              <?php echo e(request()->routeIs('dashboard') ? 'bg-white/10 shadow-lg' : 'hover:bg-white/5 hover:translate-x-1'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="font-poppins">Dashboard</span>
                    </a>

                    <a href="<?php echo e(route('admin.products.index')); ?>" 
                       class="flex items-center px-4 py-2 mt-2 text-gray-100 rounded-lg transition-all duration-200 ease-in-out font-medium
                              <?php echo e(request()->routeIs('admin.products.*') ? 'bg-white/10 shadow-lg' : 'hover:bg-white/5 hover:translate-x-1'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span class="font-poppins">Products</span>
                    </a>

                    <a href="<?php echo e(route('admin.users.index')); ?>" 
                       class="flex items-center px-4 py-2 mt-2 text-gray-100 rounded-lg transition-all duration-200 ease-in-out font-medium
                              <?php echo e(request()->routeIs('admin.users.*') ? 'bg-white/10 shadow-lg' : 'hover:bg-white/5 hover:translate-x-1'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="font-poppins">Users</span>
                    </a>

                    <a href="<?php echo e(route('admin.orders.index')); ?>" 
                       class="flex items-center px-4 py-2 mt-2 text-gray-100 rounded-lg transition-all duration-200 ease-in-out font-medium
                              <?php echo e(request()->routeIs('admin.orders.*') ? 'bg-white/10 shadow-lg' : 'hover:bg-white/5 hover:translate-x-1'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span class="font-poppins">Orders</span>
                    </a>

                    <a href="<?php echo e(route('admin.analytics')); ?>" 
                       class="flex items-center px-4 py-2 mt-2 text-gray-100 rounded-lg transition-all duration-200 ease-in-out font-medium
                              <?php echo e(request()->routeIs('admin.analytics') ? 'bg-white/10 shadow-lg' : 'hover:bg-white/5 hover:translate-x-1'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="font-poppins">Analytics</span>
                    </a>
                </nav>

                <!-- Logout Button -->
                <div class="p-4" x-data="{ showLogoutModal: false }">
                    <button @click="showLogoutModal = true" 
                            class="flex items-center px-4 py-2 text-gray-100 rounded-lg w-full transition-all duration-200 ease-in-out font-medium
                                   hover:bg-white/5 hover:translate-x-1">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="font-poppins">Logout</span>
                    </button>

                    <!-- Logout Modal -->
                    <div x-show="showLogoutModal" 
                         class="fixed inset-0 z-[9999] overflow-y-auto" 
                         style="display: none;">
                        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm"></div>
                        <div class="fixed inset-0 z-[10000] overflow-y-auto">
                            <div class="flex min-h-full items-center justify-center p-4">
                                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                </svg>
                                            </div>
                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                <h3 class="text-lg font-semibold leading-6 text-gray-900">Confirm Logout</h3>
                                                <div class="mt-2">
                                                    <p class="text-sm text-gray-500">
                                                        Are you sure you want to logout? You'll need to login again to access your account.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                                                Logout
                                            </button>
                                        </form>
                                        <button type="button" 
                                                @click="showLogoutModal = false"
                                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <!-- Notification Container -->
        <div class="fixed top-4 right-4 z-50 flex flex-col space-y-4">
            <?php if(session('success')): ?>
            <div x-data="{ show: true }"
                 x-show="show"
                 x-init="setTimeout(() => show = false, 3000)"
                 x-transition:enter="transform ease-out duration-300 transition"
                 x-transition:enter-start="translate-y-2 opacity-0"
                 x-transition:enter-end="translate-y-0 opacity-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="bg-green-50 border-l-4 border-green-500 p-4 flex items-center shadow-lg rounded-r-lg">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700 font-medium"><?php echo e(session('success')); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
            <div x-data="{ show: true }"
                 x-show="show"
                 x-init="setTimeout(() => show = false, 3000)"
                 x-transition:enter="transform ease-out duration-300 transition"
                 x-transition:enter-start="translate-y-2 opacity-0"
                 x-transition:enter-end="translate-y-0 opacity-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="bg-red-50 border-l-4 border-red-500 p-4 flex items-center shadow-lg rounded-r-lg">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700 font-medium"><?php echo e(session('error')); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html> <?php /**PATH E:\laragon\www\PTI_KELOMPOK5_IF6\resources\views/layouts/admin.blade.php ENDPATH**/ ?>