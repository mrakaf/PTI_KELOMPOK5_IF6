<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RobbStark Official Shop</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Alpine.js CDN (tambahkan jika belum ada) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageSlider', () => ({
                currentSlide: 0,
                slides: [0, 1, 2],

                init() {
                    this.startSlider();
                },

                startSlider() {
                    setInterval(() => {
                        this.next();
                    }, 5000);
                },

                next() {
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                },

                prev() {
                    this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                },

                goToSlide(index) {
                    this.currentSlide = index;
                }
            }));
        });
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }
        .slider-container {
            display: flex;
            overflow: hidden;
            width: 100%;
        }

        #slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 100%;
        }

        #slider > div {
            flex: 0 0 100%;
            width: 100%;
        }

        .category-image-container {
            height: 300px !important;
            overflow: hidden;
        }

        .category-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        @keyframes glow {
            0%, 100% {
                box-shadow: 0 0 5px rgba(255,255,255,0.5),
                            0 0 10px rgba(255,255,255,0.3);
            }
            50% {
                box-shadow: 0 0 20px rgba(255,255,255,0.8),
                            0 0 30px rgba(255,255,255,0.5);
            }
        }

        .nav-button-glow {
            animation: glow 2s infinite;
        }
    </style>
    
</head>
<body class="bg-white" x-data="{ mobileMenuOpen: false }">

    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md shadow-lg fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center space-x-3">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 text-transparent bg-clip-text">
                            RobbStark
                            <span class="block text-sm mt-0.5">Official Shop</span>
                        </span>
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="flex items-center">
                    <div class="hidden md:flex space-x-1">
                        <a href="/" 
                           class="px-4 py-2 text-gray-700 hover:text-blue-600 rounded-full hover:bg-blue-50 transition-all duration-300 text-sm font-medium">
                            Home
                        </a>
                        <a href="#products" 
                           class="px-4 py-2 text-gray-700 hover:text-blue-600 rounded-full hover:bg-blue-50 transition-all duration-300 text-sm font-medium">
                            Products
                        </a>
                        <a href="#categories" 
                           class="px-4 py-2 text-gray-700 hover:text-blue-600 rounded-full hover:bg-blue-50 transition-all duration-300 text-sm font-medium">
                            Categories
                        </a>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="hidden md:flex items-center ml-8 space-x-4">
                        <a href="<?php echo e(url('/login')); ?>" 
                           class="relative inline-flex items-center px-6 py-2.5 overflow-hidden text-sm font-medium text-gray-800 rounded-full group hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-500 hover:ring-2 hover:ring-offset-2 hover:ring-blue-500 transition-all duration-300 ease-out hover:text-white">
                            <span class="relative flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                                </svg>
                                Sign In
                            </span>
                        </a>
                        <a href="<?php echo e(url('/register')); ?>" 
                           class="relative inline-flex items-center px-6 py-2.5 overflow-hidden text-white font-medium rounded-full group bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 transform hover:scale-105 transition-all duration-300 ease-out shadow-lg hover:shadow-xl">
                            <span class="relative flex items-center">
                                <span class="mr-2">Get Started</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center md:hidden">
                        <button type="button" 
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
                                @click="mobileMenuOpen = !mobileMenuOpen">
                            <span class="sr-only">Open main menu</span>
                            <!-- Icon when menu is closed -->
                            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden" x-show="mobileMenuOpen" x-cloak>
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">Home</a>
                <a href="#products" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">Products</a>
                <a href="#categories" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">Categories</a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-5 space-x-4">
                    <a href="<?php echo e(url('/login')); ?>" 
                       class="flex-1 relative overflow-hidden px-5 py-2.5 text-center font-medium text-gray-800 rounded-lg group hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-500 hover:text-white transition-all duration-300">
                        <span class="relative flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                            </svg>
                            Sign in
                        </span>
                    </a>
                    <a href="<?php echo e(url('/register')); ?>" 
                       class="flex-1 relative overflow-hidden px-5 py-2.5 text-center font-medium text-white rounded-lg bg-gradient-to-r from-blue-500 to-purple-500 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <span class="relative flex items-center justify-center">
                            Get Started
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div x-data="{ 
        showLoginAlert: false,
        alertMessage: '',
        showAlert(message) {
            this.alertMessage = message;
            this.showLoginAlert = true;
            setTimeout(() => this.showLoginAlert = false, 3000);
        }
    }">
        <!-- Alert Notification -->
        <div x-show="showLoginAlert"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             class="fixed top-4 right-4 z-50">
            <div class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-3">
                <p x-text="alertMessage"></p>
                <a href="<?php echo e(route('register')); ?>" class="underline hover:text-blue-200">Register here</a>
            </div>
        </div>

        <div id="top">
            <!-- Hero Section with Slider -->
            <section id="hero" class="relative" x-data="imageSlider">
                <div class="relative h-[700px] overflow-hidden">
                    <div class="flex h-full" 
                         x-cloak
                         x-transition
                         :style="`transform: translateX(-${currentSlide * 100}%); transition: transform 0.5s ease-in-out;`">
                        <!-- Slide 1 -->
                        <div class="min-w-full relative">
                            <img src="<?php echo e(asset('images/hero/first.jpg')); ?>" 
                                 alt="First Slide" 
                                 class="w-full h-full object-cover object-position-top" 
                                 style="object-position: center 5%;">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent">
                                <div class="container mx-auto px-8 h-full flex items-center">
                                    <div class="max-w-xl space-y-6">
                                        <h1 class="text-6xl font-bold text-white leading-tight tracking-tight">
                                            Welcome to 
                                            <span class="block mt-2 text-7xl bg-gradient-to-r from-blue-400 to-purple-500 text-transparent bg-clip-text">
                                                RobbStark 
                                            </span>
                                        </h1>
                                        <p class="text-xl text-gray-300 font-light leading-relaxed">
                                            Discover our curated collection of premium fashion pieces that define modern elegance
                                        </p>
                                        <a href="#products" 
                                           class="inline-flex items-center px-8 py-4 text-lg font-medium text-white bg-gradient-to-r from-blue-500 to-purple-600 rounded-full transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                            Explore Collection
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="min-w-full relative">
                            <img src="<?php echo e(asset('images/hero/second.jpg')); ?>" 
                                 alt="Second Slide" 
                                 class="w-full h-full object-cover object-position-top" 
                                 style="object-position: center 0%;">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent">
                                <div class="container mx-auto px-8 h-full flex items-center">
                                    <div class="max-w-xl space-y-6">
                                        <span class="text-sm font-semibold text-blue-400 tracking-wider uppercase">New Season Collection</span>
                                        <h2 class="text-7xl font-bold text-white leading-none">
                                            New 
                                            <span class="italic text-blue-400">Arrivals</span>
                                        </h2>
                                        <p class="text-xl text-gray-300 font-light">
                                            Elevate your style with our latest fashion pieces
                                        </p>
                                        <a href="#categories" 
                                           class="group inline-flex items-center px-8 py-4 text-lg font-medium text-white bg-blue-500 rounded-full hover:bg-blue-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                            View Categories
                                            <span class="ml-2 transform group-hover:translate-x-1 transition-transform">→</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="min-w-full relative">
                            <img src="<?php echo e(asset('images/hero/third.jpg')); ?>" 
                                 alt="Third Slide" 
                                 class="w-full h-full object-cover object-position-top" 
                                 style="object-position: center 40%;">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent">
                                <div class="container mx-auto px-8 h-full flex items-center">
                                    <div class="max-w-xl space-y-6">
                                        <div class="inline-block bg-red-500 text-white px-4 py-1 rounded-full text-sm font-semibold animate-pulse">
                                            Limited Time Offer
                                        </div>
                                        <h2 class="text-6xl font-bold text-white leading-tight">
                                            Special
                                            <span class="block text-7xl text-red-500">50% OFF</span>
                                        </h2>
                                        <p class="text-xl text-gray-300 font-light">
                                            Don't miss out on our biggest sale of the season
                                        </p>
                                        <div class="flex space-x-4">
                                            <a href="#products" 
                                               class="inline-flex items-center px-8 py-4 text-lg font-medium text-white bg-red-500 rounded-full hover:bg-red-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                                Shop Now
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <button @click="prev()" 
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white rounded-full p-3 focus:outline-none transition-all duration-300 animate-pulse hover:animate-none hover:shadow-[0_0_15px_rgba(255,255,255,0.5)] hover:ring-2 hover:ring-white/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="next()" 
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/40 text-white rounded-full p-3 focus:outline-none transition-all duration-300 animate-pulse hover:animate-none hover:shadow-[0_0_15px_rgba(255,255,255,0.5)] hover:ring-2 hover:ring-white/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Navigation Dots -->
                    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-4 z-10">
                        <button @click="goToSlide(0)" 
                                class="w-4 h-4 rounded-full bg-white transition-opacity duration-300"
                                :class="{'opacity-100': currentSlide === 0, 'opacity-50': currentSlide !== 0}">
                        </button>
                        <button @click="goToSlide(1)" 
                                class="w-4 h-4 rounded-full bg-white transition-opacity duration-300"
                                :class="{'opacity-100': currentSlide === 1, 'opacity-50': currentSlide !== 1}">
                        </button>
                        <button @click="goToSlide(2)" 
                                class="w-4 h-4 rounded-full bg-white transition-opacity duration-300"
                                :class="{'opacity-100': currentSlide === 2, 'opacity-50': currentSlide !== 2}">
                        </button>
                    </div>
                </div>
            </section>

            <!-- Featured Products Section -->
            <section id="products" class="py-16 bg-gray-50">
                <div class="container mx-auto px-4">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold mb-4">Featured Products</h2>
                        <p class="text-gray-600 max-w-2xl mx-auto">
                            Discover our handpicked selection of premium fashion items, carefully curated for style and quality
                        </p>
                    </div>

                    <!-- Product Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Product Card 1 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                            <div class="relative h-[300px] overflow-hidden">
                                <img src="<?php echo e(asset('images/categories/woman.jpg')); ?>" 
                                     alt="Woman Fashion" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                    <button onclick="openModal('modal-woman')" 
                                            class="bg-white/80 p-3 rounded-full transform scale-0 group-hover:scale-100 transition-all duration-300 hover:bg-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">Women's Collection</h3>
                                <p class="text-gray-600 text-sm mb-2">New Season</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-blue-600 font-bold">$10.00</span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-yellow-400">★★★★☆</span>
                                        <span class="text-sm text-gray-500">(18)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 2 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                            <div class="relative h-[300px] overflow-hidden">
                                <img src="<?php echo e(asset('images/categories/men.jpg')); ?>" 
                                     alt="Men Fashion" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                    <button onclick="openModal('modal-men')" 
                                            class="bg-white/80 p-3 rounded-full transform scale-0 group-hover:scale-100 transition-all duration-300 hover:bg-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">Men's Collection</h3>
                                <p class="text-gray-600 text-sm mb-2">Best Seller</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-blue-600 font-bold">$8.00</span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-yellow-400">★★★★★</span>
                                        <span class="text-sm text-gray-500">(32)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 3 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                            <div class="relative h-[300px] overflow-hidden">
                                <img src="<?php echo e(asset('images/categories/zipper.jpg')); ?>" 
                                     alt="Fashion" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                    <button onclick="openModal('modal-zipper')" 
                                            class="bg-white/80 p-3 rounded-full transform scale-0 group-hover:scale-100 transition-all duration-300 hover:bg-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">Fashion Collection</h3>
                                <p class="text-gray-600 text-sm mb-2">Limited Edition</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-blue-600 font-bold">$20.00</span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-yellow-400">★★★★☆</span>
                                        <span class="text-sm text-gray-500">(21)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- View All Button -->
                    <div class="text-center mt-12">
                        <button @click="showAlert('Please login to view all products')" 
                                class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition-colors duration-300">
                            View All Products
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>
        </div>

        <!-- Categories Section -->
        <section id="categories" class="py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4">Shop by Category</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Browse through our diverse range of carefully curated categories
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Category Card 1 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
                        <div class="category-image-container relative">
                            <img src="<?php echo e(asset('images/categories/men.jpg')); ?>" 
                                 alt="Men's Fashion" 
                                 class="category-image transform group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
                                <div class="absolute bottom-4 left-4 right-4">
                                    <h3 class="text-lg text-white font-bold mb-1">Men's Fashion</h3>
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm text-gray-200">150+ Products</p>
                                        <span class="bg-white/20 px-3 py-1 rounded-full text-white text-sm">
                                            New Arrivals
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category Card 2 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
                        <div class="category-image-container relative">
                            <img src="<?php echo e(asset('images/categories/woman.jpg')); ?>" 
                                 alt="Women's Fashion" 
                                 class="category-image transform group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
                                <div class="absolute bottom-4 left-4 right-4">
                                    <h3 class="text-lg text-white font-bold mb-1">Women's Fashion</h3>
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm text-gray-200">200+ Products</p>
                                        <span class="bg-white/20 px-3 py-1 rounded-full text-white text-sm">
                                            Trending
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category Card 3 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
                        <div class="category-image-container relative">
                            <img src="<?php echo e(asset('images/categories/gelang.jpg')); ?>" 
                                 alt="Accessories" 
                                 class="category-image transform group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
                                <div class="absolute bottom-4 left-4 right-4">
                                    <h3 class="text-lg text-white font-bold mb-1">Accessories</h3>
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm text-gray-200">100+ Products</p>
                                        <span class="bg-white/20 px-3 py-1 rounded-full text-white text-sm">
                                            Popular
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category Card 4 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
                        <div class="category-image-container relative">
                            <img src="<?php echo e(asset('images/categories/zipper.jpg')); ?>" 
                                 alt="Fashion" 
                                 class="category-image transform group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
                                <div class="absolute bottom-4 left-4 right-4">
                                    <h3 class="text-lg text-white font-bold mb-1">Fashion</h3>
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm text-gray-200">80+ Products</p>
                                        <span class="bg-white/20 px-3 py-1 rounded-full text-white text-sm">
                                            Best Seller
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
                    <div class="text-center">
                        <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Fast Delivery</h3>
                        <p class="text-gray-600">Quick delivery to your doorstep</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Quality Assured</h3>
                        <p class="text-gray-600">100% quality check on all items</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Secure Payment</h3>
                        <p class="text-gray-600">Multiple payment options</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">About Us</h3>
                        <p class="text-gray-400">Your trusted destination for fashion and style.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="#top" class="text-gray-400 hover:text-white transition-colors duration-300">Home</a></li>
                            <li><a href="#products" class="text-gray-400 hover:text-white transition-colors duration-300">Products</a></li>
                            <li><a href="#categories" class="text-gray-400 hover:text-white transition-colors duration-300">Categories</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contact</h3>
                        <ul class="space-y-2">
                            <li class="text-gray-400">Email: info@fashionstore.com</li>
                            <li class="text-gray-400">Phone: (123) 456-7890</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                        <form class="flex">
                            <input type="email" placeholder="Your email" class="flex-1 px-4 py-2 rounded-l-md">
                            <button class="bg-blue-500 px-4 py-2 rounded-r-md hover:bg-blue-600">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                    <p class="text-gray-400">&copy; 2024 RobbStark Official Shop. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- AOS JS -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 800,
                once: true,
                offset: 100
            });
        </script>

        <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Menangani klik pada tombol login dan register
                const loginLinks = document.querySelectorAll('a[href="<?php echo e(route("login")); ?>"]');
                const registerLinks = document.querySelectorAll('a[href="<?php echo e(route("register")); ?>"]');

                loginLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        window.location.href = "<?php echo e(route('login')); ?>";
                    });
                });

                registerLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        window.location.href = "<?php echo e(route('register')); ?>";
                    });
                });
            });
        </script>
        <?php $__env->stopPush(); ?>
    </div>

    <!-- Modal for Woman Image -->
    <div id="modal-woman" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="min-h-screen px-4 py-6 flex items-center justify-center">
            <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" onclick="closeModal('modal-woman')"></div>
            <div class="relative bg-white rounded-lg max-w-3xl mx-auto">
                <div class="relative">
                    <img src="<?php echo e(asset('images/categories/woman.jpg')); ?>" 
                         alt="Woman Collection Full Size" 
                         class="w-full h-auto max-h-[80vh] object-contain">
                    <button onclick="closeModal('modal-woman')" 
                            class="absolute top-2 right-2 text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Men Image -->
    <div id="modal-men" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="min-h-screen px-4 py-6 flex items-center justify-center">
            <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" onclick="closeModal('modal-men')"></div>
            <div class="relative bg-white rounded-lg max-w-3xl mx-auto">
                <div class="relative">
                    <img src="<?php echo e(asset('images/categories/men.jpg')); ?>" 
                         alt="Men Collection Full Size" 
                         class="w-full h-auto max-h-[80vh] object-contain">
                    <button onclick="closeModal('modal-men')" 
                            class="absolute top-2 right-2 text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Zipper Image -->
    <div id="modal-zipper" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="min-h-screen px-4 py-6 flex items-center justify-center">
            <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" onclick="closeModal('modal-zipper')"></div>
            <div class="relative bg-white rounded-lg max-w-3xl mx-auto">
                <div class="relative">
                    <img src="<?php echo e(asset('images/categories/zipper.jpg')); ?>" 
                         alt="Fashion Collection Full Size" 
                         class="w-full h-auto max-h-[80vh] object-contain">
                    <button onclick="closeModal('modal-zipper')" 
                            class="absolute top-2 right-2 text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the image
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('bg-opacity-75')) {
                const modal = event.target.parentElement;
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });

        // Close modal with escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = document.querySelectorAll('[id^="modal-"]');
                modals.forEach(modal => {
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menangani klik pada tombol login dan register
            const loginLinks = document.querySelectorAll('a[href="<?php echo e(route("login")); ?>"]');
            const registerLinks = document.querySelectorAll('a[href="<?php echo e(route("register")); ?>"]');

            loginLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    window.location.href = "<?php echo e(route('login')); ?>";
                });
            });

            registerLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    window.location.href = "<?php echo e(route('register')); ?>";
                });
            });
        });
    </script>
</body>
</html> <?php /**PATH C:\laragon\www\uas_pti\resources\views/landing/index.blade.php ENDPATH**/ ?>