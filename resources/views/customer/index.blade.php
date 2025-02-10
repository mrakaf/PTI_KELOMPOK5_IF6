<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RobbStark Shop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- NProgress untuk loading bar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

    <!-- Custom loading style -->
    <style>
        /* Loading overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.98);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }

        .loading-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* Custom NProgress bar */
        #nprogress .bar {
            background: linear-gradient(to right, #4f46e5, #7c3aed) !important;
            height: 3px !important;
        }

        #nprogress .peg {
            box-shadow: 0 0 10px #4f46e5, 0 0 5px #7c3aed !important;
        }

        #nprogress .spinner-icon {
            border-top-color: #4f46e5 !important;
            border-left-color: #7c3aed !important;
        }

        /* Smooth page transitions */
        .page-transition-enter {
            opacity: 0;
            transform: translateY(20px);
        }

        .page-transition-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }

        /* Cascade animation classes */
        .cascade-item {
            opacity: 0;
            transform: translateY(-50px);
        }

        .cascade-animate {
            animation: cascadeDown 0.6s ease forwards;
        }

        @keyframes cascadeDown {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Menambahkan delay untuk setiap elemen */
        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.2s;
        }

        .delay-3 {
            animation-delay: 0.3s;
        }

        .delay-4 {
            animation-delay: 0.4s;
        }

        .delay-5 {
            animation-delay: 0.5s;
        }

        .typewriter-container {
            position: relative;
            min-height: 80px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 800px;
            margin: 0 auto;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .typewriter-container::before {
            content: '';
            position: absolute;
            inset: -5px;
            background: linear-gradient(45deg,
                    rgba(255, 0, 0, 0.5),
                    rgba(255, 165, 0, 0.5),
                    rgba(255, 255, 0, 0.5),
                    rgba(0, 128, 0, 0.5),
                    rgba(0, 0, 255, 0.5),
                    rgba(75, 0, 130, 0.5),
                    rgba(238, 130, 238, 0.5));
            filter: blur(20px);
            opacity: 0.3;
            animation: rainbow-border 5s linear infinite;
        }

        .typewriter-text {
            position: relative;
            width: fit-content;
            margin: 0 auto;
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        /* Rainbow cursor effect */
        .typewriter-text::after {
            content: '';
            position: absolute;
            right: -4px;
            top: 0;
            height: 100%;
            width: 3px;
            animation:
                cursor-blink 1s step-end infinite,
                cursor-rainbow 3s linear infinite;
        }

        /* Glowing effect for emojis */
        .emoji {
            display: inline-block;
            filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.5));
            animation: emoji-float 3s ease-in-out infinite;
        }

        /* New animations */
        @keyframes shine-effect {
            0% {
                transform: translateX(-100%);
            }

            20%,
            100% {
                transform: translateX(100%);
            }
        }

        @keyframes cursor-rainbow {
            0% {
                background-color: #ff0000;
            }

            20% {
                background-color: #ff9900;
            }

            40% {
                background-color: #33cc33;
            }

            60% {
                background-color: #3399ff;
            }

            80% {
                background-color: #cc33cc;
            }

            100% {
                background-color: #ff0000;
            }
        }

        @keyframes emoji-float {

            0%,
            100% {
                transform: translateY(0) rotate(0);
            }

            50% {
                transform: translateY(-5px) rotate(5deg);
            }
        }

        /* Particle effects */
        .particle {
            position: absolute;
            pointer-events: none;
            opacity: 0;
            animation: particle-animation 1s ease-out forwards;
        }

        @keyframes particle-animation {
            0% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }

            100% {
                transform: translateY(-20px) scale(0);
                opacity: 0;
            }
        }

        @keyframes rainbow-border {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .nav-container {
            background: linear-gradient(to right, #0f172a, #1e293b, #334155) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* 3D Transform Effect */
        .perspective-text {
            transform-style: preserve-3d;
            transition: transform 0.3s ease;
        }

        .perspective-text:hover {
            transform: translateZ(50px) rotateX(10deg) rotateY(10deg);
        }

        /* Floating Elements */
        .floating-element {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0) rotate(0);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        .sticky-nav {
            position: sticky;
            top: 0;
            background-color: transparent;
            transition: all 0.3s ease;
        }

        /* Optional: Add some shadow when scrolling */
        .sticky-nav.scrolled {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Ensure content starts below navbar */
        main {
            padding-top: 4rem;
            /* Adjust based on navbar height */
        }

        /* Update style untuk navbar */
        #mainNav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
            /* Memastikan navbar selalu di atas konten lain */
            margin-bottom: 0;
        }

        /* Tambahkan padding-top pada konten utama agar tidak tertutup navbar */
        .x-customer-layout {
            padding-top: 0;
        }

        /* Efek hover untuk product card */
        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Badge untuk produk baru/sale */
        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 10;
            backdrop-filter: blur(8px);
        }

        .badge-new {
            background: rgba(59, 130, 246, 0.9);
            color: white;
        }

        .badge-sale {
            background: rgba(239, 68, 68, 0.9);
            color: white;
        }

        /* Efek gradient untuk tombol */
        .btn-gradient {
            background-size: 200% auto;
            transition: 0.5s;
        }

        .btn-gradient:hover {
            background-position: right center;
        }

        /* Animasi loading skeleton */
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }

        /* Dropdown animations */
        .group:hover .group-hover\:block {
            animation: fadeIn 0.2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile menu animations */
        @media (max-width: 768px) {
            .nav-container {
                padding-bottom: env(safe-area-inset-bottom);
            }
        }

        @keyframes shine {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(100%);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.5);
            }
        }

        .animate-ping {
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        @keyframes ping {

            75%,
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* Styling untuk dropdown */
        .group:hover .absolute,
        .group.dropdown-active .absolute {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }

        /* Tambahkan gap/padding untuk menghubungkan button dengan dropdown */
        .group>.absolute::before {
            content: '';
            position: absolute;
            top: -8px;
            left: 0;
            right: 0;
            height: 8px;
            background: transparent;
        }

        /* Animasi smooth untuk dropdown */
        .group>.absolute {
            transition: all 0.2s ease-in-out;
        }

        /* Sweet Alert Custom Style */
        .swal2-popup {
            border-radius: 1rem;
            padding: 2rem;
        }

        .swal2-confirm {
            background: linear-gradient(to right, #ef4444, #dc2626) !important;
            border-radius: 0.5rem !important;
            padding: 0.75rem 1.5rem !important;
        }

        .swal2-cancel {
            background: #4b5563 !important;
            border-radius: 0.5rem !important;
            padding: 0.75rem 1.5rem !important;
        }

        /* Optional: Tambahkan smooth transition saat scroll */
        .nav-container {
            transition: background-color 0.3s ease;
        }

        /* Update mobile search background color */
        .md\:hidden.bg-indigo-800 {
            background: linear-gradient(to right, #0f172a, #1e293b) !important;
        }

        .interactive-background {
            perspective: 1000px;
        }

        .floating-circle {
            animation: floatAnimation 6s infinite ease-in-out;
        }

        .animation-delay-500 {
            animation-delay: 0.5s;
        }

        .animation-delay-1000 {
            animation-delay: 1s;
        }

        @keyframes floatAnimation {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg) scale(1);
            }

            25% {
                transform: translate(150px, 75px) rotate(90deg) scale(1.1);
            }

            50% {
                transform: translate(75px, 150px) rotate(180deg) scale(1);
            }

            75% {
                transform: translate(-75px, 75px) rotate(270deg) scale(1.1);
            }
        }

        .trail-dot {
            position: absolute;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: linear-gradient(to right, rgba(99, 102, 241, 0.5), rgba(168, 85, 247, 0.5));
            pointer-events: none;
            transition: all 0.15s ease;
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.3);
        }
        
    </style>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Cormorant+Garamond:wght@400;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-minimal/minimal.css" rel="stylesheet">
</head>

<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav id="mainNav" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="nav-container bg-gradient-to-r from-indigo-700 to-purple-700 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo dan Search Bar -->
                    <div class="flex-1 flex items-center space-x-8">
                        <!-- Logo -->
                        <a href="{{ route('customer.index') }}" class="flex-shrink-0 flex items-center space-x-2">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <h1 class="text-2xl font-bold text-white">RobbStark Shop</h1>
                        </a>

                        <!-- Search Bar
                        {{-- <div class="hidden md:block flex-1 max-w-lg">
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
                    </div> --}} -->

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('customer.index')" :active="request()->routeIs('customer.index')" class="text-white">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Home
                            </x-nav-link>

                            <x-nav-link :href="route('customer.orders')" :active="request()->routeIs('customer.orders')" class="text-white">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                My Orders
                            </x-nav-link>

                            <x-nav-link :href="route('customer.cart')" :active="request()->routeIs('customer.cart')" class="text-white">
                                <div class="relative">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    @if (auth()->user()->carts->count() > 0)
                                        <span
                                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                                            {{ auth()->user()->carts->count() }}
                                        </span>
                                    @endif
                                </div>
                                Cart
                            </x-nav-link>


                        </div>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative" x-data="{ open: false }" @mouseenter="open = true"
                            @mouseleave="setTimeout(() => { if (!$el.matches(':hover')) open = false }, 100)">
                            <div>
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:bg-[#334155] focus:outline-none transition-all duration-300 ease-in-out">
                                    <div class="flex items-center space-x-3">
                                        <!-- Avatar with Initial -->
                                        <div
                                            class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-[#0f172a] font-semibold transform transition-transform duration-300 hover:scale-105">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </div>
                                        <div class="flex flex-col items-start">
                                            <span>{{ Auth::user()->name }}</span>
                                            <span class="text-xs text-gray-300">{{ Auth::user()->email }}</span>
                                        </div>
                                    </div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4 transform transition-transform duration-300"
                                            :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </div>

                            <div x-show="open" @mouseenter="open = true" @mouseleave="open = false"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="transform opacity-0 scale-95 translate-y-2"
                                x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="transform opacity-0 scale-95 translate-y-2"
                                class="absolute right-0 w-60 mt-2 py-2 bg-white border border-gray-100 rounded-lg shadow-xl z-50"
                                style="display: none;">

                                <!-- Profile Info -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm text-gray-500">Signed in as</p>
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                <!-- Navigation -->
                                <div class="py-2">
                                    <x-dropdown-link :href="route('customer.profile')"
                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                        <i
                                            class="fas fa-user-circle w-5 mr-2 transition-transform duration-200 group-hover:scale-110"></i>
                                        {{ __('Profile Settings') }}
                                    </x-dropdown-link>





                                    <x-dropdown-link :href="route('customer.addresses.index')"
                                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                        <i
                                            class="fas fa-map-marker-alt w-5 mr-2 transition-transform duration-200 group-hover:scale-110"></i>
                                        {{ __('My Addresses') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link href="#"
                                            class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200"
                                            onclick="event.preventDefault(); confirmLogout();">
                                            <i
                                                class="fas fa-sign-out-alt w-5 mr-2 transition-transform duration-200 group-hover:scale-110"></i>
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </div>
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

    <!-- Tambahkan setelah navbar dan sebelum hero section -->
    <div class="interactive-background fixed inset-0 pointer-events-none z-0">
        <!-- Animated Grid dengan opacity yang lebih tinggi -->
        <div class="absolute inset-0 grid grid-cols-12 grid-rows-12 gap-4 opacity-10">
            @for ($i = 0; $i < 144; $i++)
                <div class="bg-white/20 rounded-lg transform hover:scale-110 transition-transform duration-300"></div>
            @endfor
        </div>

        <!-- Floating Elements dengan ukuran dan opacity yang lebih besar -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="floating-circle absolute w-48 h-48 bg-gradient-to-r from-purple-500/30 to-indigo-500/30 rounded-full blur-lg">
            </div>
            <div
                class="floating-circle animation-delay-500 absolute w-56 h-56 bg-gradient-to-r from-pink-500/30 to-rose-500/30 rounded-full blur-lg">
            </div>
            <div
                class="floating-circle animation-delay-1000 absolute w-52 h-52 bg-gradient-to-r from-amber-500/30 to-orange-500/30 rounded-full blur-lg">
            </div>
        </div>

        <!-- Mouse Trail Effect yang lebih responsif -->
        <div id="mouse-trail" class="pointer-events-none"></div>
    </div>

    <x-customer-layout>
        <!-- Hero Section with Luxury Elements -->
        <div class="relative overflow-hidden bg-gradient-to-r from-[#0f172a] via-[#1e293b] to-[#334155] mb-16">
            <!-- Animated Luxury Pattern Background -->
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-repeat opacity-5"
                    style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%239C92AC\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
                </div>
            </div>

            <!-- Animated Gradient Orbs -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -inset-[10px] opacity-30">
                    <div
                        class="absolute top-0 -left-4 w-96 h-96 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full mix-blend-multiply filter blur-3xl animate-luxury-blob">
                    </div>
                    <div
                        class="absolute top-0 -right-4 w-96 h-96 bg-gradient-to-r from-amber-300 to-orange-500 rounded-full mix-blend-multiply filter blur-3xl animate-luxury-blob animation-delay-2000">
                    </div>
                    <div
                        class="absolute -bottom-8 left-20 w-96 h-96 bg-gradient-to-r from-pink-500 to-rose-500 rounded-full mix-blend-multiply filter blur-3xl animate-luxury-blob animation-delay-4000">
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 py-20 items-center">
                    <!-- Left Content -->
                    <div class="text-center lg:text-left space-y-8">
                        <!-- Animated Badge -->
                        <div
                            class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-lg rounded-full text-white/90 text-sm animate-fade-in-up">
                            <span class="animate-pulse w-2 h-2 bg-emerald-400 rounded-full mr-2"></span>
                            New Collection Available
                        </div>

                        <h1
                            class="text-5xl md:text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-200 to-gray-400 mb-6 animate-fade-in-up animation-delay-300">
                            Elevate Your Style
                        </h1>

                        <p class="text-xl text-white/80 leading-relaxed mb-8 animate-fade-in-up animation-delay-600">
                            Discover our curated collection of premium fashion pieces designed to make you stand out.
                            <span class="block mt-4 text-white/60">Luxury meets comfort in every piece.</span>
                        </p>

                        <div
                            class="flex flex-wrap gap-6 justify-center lg:justify-start animate-fade-in-up animation-delay-900">
                            <a href="#featured-categories"
                                class="group relative px-8 py-4 bg-white text-gray-900 rounded-xl font-semibold overflow-hidden">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                                </div>
                                <span class="relative group-hover:text-white transition-colors duration-300">Explore
                                    Collection</span>
                            </a>
                            <a href="#new-arrivals"
                                class="group px-8 py-4 border border-white/30 text-white rounded-xl font-semibold backdrop-blur-lg hover:bg-white/10 transition-all duration-300">
                                <span>View Lookbook</span>
                                <span class="ml-2 group-hover:ml-4 transition-all duration-300">→</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Content - Premium Image Gallery -->
                    <div class="relative">
                        <div class="grid grid-cols-2 gap-6 animate-float-luxury">
                            <!-- Image Grid with Hover Effects -->
                            <div class="space-y-6">
                                <div
                                    class="group relative rounded-2xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-500">
                                    <img src="{{ asset('images/products/jacket2.jpg') }}" alt="Fashion"
                                        class="w-full h-48 object-cover">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                </div>
                                <div
                                    class="group relative rounded-2xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-500">
                                    <img src="{{ asset('images/products/jacket1.jpg') }}" alt="Fashion"
                                        class="w-full h-64 object-cover">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-6 pt-12">
                                <div
                                    class="group relative rounded-2xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-500">
                                    <img src="{{ asset('images/products/leatherjacket.jpg') }}" alt="Fashion"
                                        class="w-full h-64 object-cover">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                </div>
                                <div
                                    class="group relative rounded-2xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-500">
                                    <img src="{{ asset('images/products/jacket3.jpg') }}" alt="Fashion"
                                        class="w-full h-48 object-cover">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                </div>
                            </div>

                            <!-- Decorative Elements -->
                            <div
                                class="absolute -top-20 -right-20 w-40 h-40 border border-white/10 rounded-full animate-spin-slow">
                            </div>
                            <div
                                class="absolute -bottom-10 -left-10 w-20 h-20 border border-white/10 rounded-full animate-spin-slow">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update/Add Styles -->
        <style>
            @keyframes luxury-blob {
                0% {
                    transform: translate(0px, 0px) scale(1) rotate(0deg);
                }

                33% {
                    transform: translate(30px, -50px) scale(1.2) rotate(120deg);
                }

                66% {
                    transform: translate(-20px, 20px) scale(0.8) rotate(240deg);
                }

                100% {
                    transform: translate(0px, 0px) scale(1) rotate(360deg);
                }
            }

            @keyframes float-luxury {
                0% {
                    transform: translateY(0px) rotate(0deg);
                }

                50% {
                    transform: translateY(-20px) rotate(1deg);
                }

                100% {
                    transform: translateY(0px) rotate(0deg);
                }
            }

            .animate-luxury-blob {
                animation: luxury-blob 20s infinite;
            }

            .animate-float-luxury {
                animation: float-luxury 8s ease-in-out infinite;
            }

            .animate-spin-slow {
                animation: spin 15s linear infinite;
            }

            .animation-delay-2000 {
                animation-delay: 2s;
            }

            .animation-delay-4000 {
                animation-delay: 4s;
            }

            .animate-fade-in-up {
                animation: fadeInUp 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animation-delay-300 {
                animation-delay: 300ms;
            }

            .animation-delay-600 {
                animation-delay: 600ms;
            }

            .animation-delay-900 {
                animation-delay: 900ms;
            }
        </style>

        <!-- Add Particles.js -->
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                particlesJS('particles-js', {
                    particles: {
                        number: {
                            value: 80
                        },
                        color: {
                            value: '#ffffff'
                        },
                        opacity: {
                            value: 0.2
                        },
                        size: {
                            value: 3
                        },
                        line_linked: {
                            enable: true,
                            distance: 150,
                            color: '#ffffff',
                            opacity: 0.1,
                            width: 1
                        },
                        move: {
                            enable: true,
                            speed: 2
                        }
                    }
                });
            });
        </script>


        <!-- Featured Categories Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2
                class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 mb-12">
                Featured Categories
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Clothing Category -->
                <a href="#"
                    class="group relative rounded-2xl overflow-hidden bg-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="aspect-w-1 aspect-h-1">
                        <img src="{{ asset('images/products/jacket1.jpg') }}" alt="Clothing"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        <div

                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300">
                        </div>
                        <div class="absolute inset-0 flex flex-col justify-end p-6">
                            <h3
                                class="text-2xl font-bold text-white mb-2 transform group-hover:translate-x-2 transition-transform duration-300">
                                Clothing</h3>
                            <p
                                class="text-white/90 text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Discover our latest fashion collection
                            </p>
                            <div
                                class="mt-4 flex items-center text-white/80 text-sm transform translate-y-8 group-hover:translate-y-0 transition-transform duration-300">
                                <span>Shop Now</span>
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Shoes Category -->
                <a href="#"
                    class="group relative rounded-2xl overflow-hidden bg-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="aspect-w-1 aspect-h-1">
                        <img src="{{ asset('images/products/loafers.jpg') }}" alt="Shoes"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300">
                        </div>
                        <div class="absolute inset-0 flex flex-col justify-end p-6">
                            <h3
                                class="text-2xl font-bold text-white mb-2 transform group-hover:translate-x-2 transition-transform duration-300">
                                Shoes</h3>
                            <p
                                class="text-white/90 text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Perfect fit for your style
                            </p>
                            <div
                                class="mt-4 flex items-center text-white/80 text-sm transform translate-y-8 group-hover:translate-y-0 transition-transform duration-300">
                                <span>Shop Now</span>
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Accessories Category -->
                <a href="#"
                    class="group relative rounded-2xl overflow-hidden bg-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="aspect-w-1 aspect-h-1">
                        <img src="{{ asset('images/products/gelang.jpg') }}" alt="Accessories"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300">
                        </div>
                        <div class="absolute inset-0 flex flex-col justify-end p-6">
                            <h3
                                class="text-2xl font-bold text-white mb-2 transform group-hover:translate-x-2 transition-transform duration-300">
                                Accessories</h3>
                            <p
                                class="text-white/90 text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Complete your look
                            </p>
                            <div
                                class="mt-4 flex items-center text-white/80 text-sm transform translate-y-8 group-hover:translate-y-0 transition-transform duration-300">
                                <span>Shop Now</span>
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Our Products Section dengan desain yang diupgrade -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex justify-between items-center mb-12">
                <h2
                    class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600">
                    Our Productssss
                </h2>
                <div class="flex items-center gap-4">
                    <!-- Filter Dropdown -->
                    <div class="relative">
                        <select
                            class="appearance-none px-4 py-2 rounded-xl bg-white/80 backdrop-blur-lg border border-gray-200 text-gray-700 cursor-pointer hover:bg-white transition-all duration-300 pr-10">
                            <option>All Categories</option>
                            <option>Jackets</option>
                            <option>T-Shirts</option>
                            <option>Pants</option>
                            <option>Accessories</option>
                        </select>
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Sort Dropdown -->
                    <div class="relative">
                        <select
                            class="appearance-none px-4 py-2 rounded-xl bg-white/80 backdrop-blur-lg border border-gray-200 text-gray-700 cursor-pointer hover:bg-white transition-all duration-300 pr-10">
                            <option>Latest</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Most Popular</option>
                        </select>
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 group relative">
                        <!-- Product Image dengan Quick View Overlay -->
                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover object-center transform group-hover:scale-110 transition-transform duration-500">

                            <!-- Quick View Overlay -->
                            <div
                                class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <button onclick="quickView({{ $product->id }})"
                                    class="px-6 py-3 bg-white/90 backdrop-blur-sm text-gray-900 rounded-full hover:bg-white transition-all duration-300 flex items-center gap-2 transform hover:scale-105">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Quick View
                                </button>
                            </div>

                            <!-- Badge untuk status produk -->
                            @if ($product->stock < 5 && $product->stock > 0)
                                <div
                                    class="absolute top-4 left-4 px-3 py-1 bg-red-500 text-white text-xs font-semibold rounded-full">
                                    Limited Stock
                                </div>
                            @elseif($product->stock == 0)
                                <div
                                    class="absolute top-4 left-4 px-3 py-1 bg-gray-500 text-white text-xs font-semibold rounded-full">
                                    Sold Out
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-1">{{ $product->name }}
                            </h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>

                            <!-- Price and Rating -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xl font-bold text-indigo-600">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                <!-- Dummy Rating - Bisa disesuaikan dengan data real -->
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">4.5</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center gap-2">
                                <button onclick="addToCart({{ $product->id }})"
                                    class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white p-3 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 group">
                                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-12"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <span class="font-medium">Add to Cart</span>
                                </button>
                                {{-- 
                                <button onclick="toggleWishlist({{ $product->id }})"
                                    data-wishlist-product="{{ $product->id }}"
                                    class="p-3 text-gray-600 hover:text-red-500 bg-gray-100 hover:bg-red-50 rounded-xl transition-all duration-300 transform hover:scale-105">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($products->hasPages())
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
        </div>
        </div>
    </x-customer-layout>

    @push('scripts')
        <script>
            // Fungsi untuk menambahkan ke cart
            function addToCart(productId) {
                NProgress.start();

                // Tambahkan header X-CSRF-TOKEN
                const token = document.querySelector('meta[name="csrf-token"]').content;

                fetch(`/customer/cart/add/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        // Hapus Content-Type dan body karena kita menggunakan URL parameter
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Success:', data); // Tambahkan log untuk debugging
                        if (data.success) {
                            // Update cart counter
                            const cartCounter = document.querySelector('.cart-counter');
                            if (cartCounter) {
                                cartCounter.textContent = data.cartCount;
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        NProgress.done();
                    })
                    .catch(error => {
                        console.error('Error:', error); // Tambahkan log untuk debugging
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to add to cart',
                            confirmButtonColor: '#4F46E5'
                        });
                        NProgress.done();
                    });
            }

            // Fungsi untuk toggle wishlist
            function toggleWishlist(productId) {
                NProgress.start();

                const token = document.querySelector('meta[name="csrf-token"]').content;

                fetch(`/customer/wishlist/add/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Success:', data); // Tambahkan log untuk debugging
                        if (data.success) {
                            // Update wishlist counter
                            const wishlistCounter = document.querySelector('.wishlist-counter');
                            if (wishlistCounter) {
                                wishlistCounter.textContent = data.wishlistCount;
                            }

                            // Update wishlist icon
                            const wishlistIcon = document.querySelector(`button[data-wishlist-product="${productId}"] svg`);
                            if (wishlistIcon) {
                                if (data.message.includes('added')) {
                                    wishlistIcon.classList.add('text-red-500', 'fill-current');
                                } else {
                                    wishlistIcon.classList.remove('text-red-500', 'fill-current');
                                }
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        NProgress.done();
                    })
                    .catch(error => {
                        console.error('Error:', error); // Tambahkan log untuk debugging
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to update wishlist',
                            confirmButtonColor: '#4F46E5'
                        });
                        NProgress.done();
                    });
            }

            // Update initial wishlist states
            document.addEventListener('DOMContentLoaded', function() {
                // Get all wishlist buttons
                const wishlistButtons = document.querySelectorAll('[data-wishlist-product]');

                // Get current user's wishlist
                fetch('/customer/wishlist/count')
                    .then(response => response.json())
                    .then(data => {
                        wishlistButtons.forEach(button => {
                            const productId = button.dataset.wishlistProduct;
                            if (data.wishlisted_products.includes(parseInt(productId))) {
                                const heartIcon = button.querySelector('svg');
                                heartIcon.classList.add('text-red-500', 'fill-current');
                            }
                        });
                    });
            });
        </script>
    @endpush

    <!-- Newsletter Section dengan desain yang diupgrade -->
    <div class="relative overflow-hidden bg-gradient-to-r from-[#0f172a] via-[#1e293b] to-[#334155] py-16 mt-16">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 opacity-10">
                <div
                    class="absolute top-0 -left-4 w-96 h-96 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full mix-blend-multiply filter blur-3xl animate-pulse">
                </div>
                <div
                    class="absolute bottom-0 -right-4 w-96 h-96 bg-gradient-to-r from-amber-300 to-orange-500 rounded-full mix-blend-multiply filter blur-3xl animate-pulse animation-delay-500">
                </div>
            </div>
        </div>

        <!-- Newsletter Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2
                    class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-200 to-gray-400 mb-6">
                    Join Our Fashion Community
                </h2>
                <p class="text-white/80 text-lg mb-8 max-w-2xl mx-auto leading-relaxed">
                    Subscribe to unlock exclusive offers, early access to new collections, and personalized style
                    recommendations.
                </p>

                <!-- Newsletter Form -->
                <form class="max-w-md mx-auto">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1 relative">
                            <input type="email" placeholder="Enter your email"
                                class="w-full px-6 py-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 backdrop-blur-lg transition-all duration-300">
                            <div
                                class="absolute inset-0 rounded-xl bg-gradient-to-r from-white/5 to-transparent pointer-events-none">
                            </div>
                        </div>
                        <button type="submit"
                            class="px-8 py-4 rounded-xl bg-white text-gray-900 font-semibold hover:bg-opacity-90 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            Subscribe
                        </button>
                    </div>
                </form>

                <!-- Benefits -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                    <div
                        class="p-6 rounded-xl bg-white/5 backdrop-blur-lg border border-white/10 transform hover:scale-105 transition-all duration-300">
                        <svg class="w-10 h-10 text-white/80 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                            </path>
                        </svg>
                        <h3 class="text-white font-semibold mb-2">Early Access</h3>
                        <p class="text-white/70">Be the first to shop new arrivals</p>
                    </div>
                    <div
                        class="p-6 rounded-xl bg-white/5 backdrop-blur-lg border border-white/10 transform hover:scale-105 transition-all duration-300">
                        <svg class="w-10 h-10 text-white/80 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <h3 class="text-white font-semibold mb-2">Exclusive Offers</h3>
                        <p class="text-white/70">Special discounts for subscribers</p>
                    </div>
                    <div
                        class="p-6 rounded-xl bg-white/5 backdrop-blur-lg border border-white/10 transform hover:scale-105 transition-all duration-300">
                        <svg class="w-10 h-10 text-white/80 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <h3 class="text-white font-semibold mb-2">Style Updates</h3>
                        <p class="text-white/70">Latest fashion trends & tips</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} RobbStark Shop. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Tambahkan setelah <body> -->
    <div class="loading-overlay hidden" id="loadingOverlay">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-indigo-600"></div>
    </div>

    <!-- Tambahkan di bagian bawah sebelum </body> -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sembunyikan loading overlay saat halaman selesai dimuat
            const loadingOverlay = document.getElementById('loadingOverlay');
            if (loadingOverlay) {
                loadingOverlay.classList.add('hidden');
            }

            // Konfigurasi NProgress
            NProgress.configure({
                minimum: 0.1,
                showSpinner: false,
                speed: 200
            });
            NProgress.done(); // Pastikan NProgress selesai

            // Perbaikan fungsi quickView
            window.quickView = function(productId) {
                NProgress.start();

                // Perbaikan URL dengan menambahkan /show
                fetch(`/customer/products/show/${productId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const modalContent = `
                            <div id="quickViewModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                    <!-- Background overlay -->
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                                         aria-hidden="true"
                                         onclick="closeQuickView()"></div>

                                    <!-- Modal panel -->
                                    <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                                        <div class="absolute top-4 right-4 z-50">
                                            <button type="button" 
                                                    onclick="closeQuickView()"
                                                    class="bg-white rounded-full p-2 text-gray-400 hover:text-gray-500 focus:outline-none transition-colors duration-300">
                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="flex flex-col md:flex-row">
                                            <!-- Product Image - Larger and more prominent -->
                                            <div class="w-full md:w-1/2">
                                                <div class="relative aspect-square">
                                                    <img src="/images/products/${data.image}" 
                                                         alt="${data.name}"
                                                         class="w-full h-full object-cover">
                                                </div>
                                            </div>

                                            <!-- Product Info - Better organized -->
                                            <div class="w-full md:w-1/2 p-8">
                                                <div class="mb-6">
                                                    <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                                        ${data.name}
                                                    </h2>
                                                    <p class="text-3xl font-bold text-indigo-600 mb-4">
                                                        Rp ${new Intl.NumberFormat('id-ID').format(data.price)}
                                                    </p>
                                                    <div class="flex items-center mb-4">
                                                        <span class="px-3 py-1 text-sm text-indigo-600 bg-indigo-100 rounded-full">
                                                            Stock: ${data.stock}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="mb-6">
                                                    <h3 class="text-sm font-medium text-gray-900 mb-2">Description</h3>
                                                    <p class="text-gray-600 text-sm leading-relaxed">
                                                        ${data.description}
                                                    </p>
                                                </div>

                                                <div class="flex gap-4">
                                                    <button type="button" 
                                                            onclick="addToCart(${data.id})"
                                                            class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition-colors duration-300 flex items-center justify-center gap-2">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                        </svg>
                                                        Add to Cart
                                                    </button>

                                                    <button type="button" 
                                                            onclick="toggleWishlist(${data.id})"
                                                            class="px-6 py-3 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors duration-300">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                        document.body.insertAdjacentHTML('beforeend', modalContent);
                        NProgress.done();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        NProgress.done();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to load product details. Please try again later.',
                            confirmButtonColor: '#4F46E5'
                        });
                    });
            };

            // Fungsi untuk menutup modal
            window.closeQuickView = function() {
                const modal = document.getElementById('quickViewModal');
                if (modal) {
                    modal.remove();
                }
            };

            // Close modal when clicking outside
            document.addEventListener('click', function(e) {
                const modal = document.getElementById('quickViewModal');
                if (modal && e.target.classList.contains('bg-opacity-75')) {
                    closeQuickView();
                }
            });
        });

        // Hapus event listener yang tidak perlu
        window.addEventListener('beforeunload', null);
    </script>

    <!-- Quick View Modal Template -->
    <template id="quickViewModal">
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="absolute top-0 right-0 pt-4 pr-4">
                        <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeQuickView()">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="bg-white p-6">
                        <!-- Content will be dynamically inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Di bagian bawah sebelum </body> -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        // Perbaikan script typewriter
        document.addEventListener('DOMContentLoaded', function() {
            const textElement = document.querySelector('.typewriter-text');
            const words = [
                "Where Style Meets Elegance ✨",
                "Discover Your Perfect Look 👗",
                "Fashion That Speaks Your Language 🌟",
                "Crafted for Your Unique Style 💫",
                "Elevate Your Wardrobe Today ✨",
                "Experience Premium Fashion 🎀",
                "Your Style Journey Begins Here 🚀"
            ];

            let currentWordIndex = 0;
            let currentCharIndex = 0;
            let isDeleting = false;
            let isWaiting = false;

            function typeWriter() {
                const currentWord = words[currentWordIndex];
                const shouldDelete = isDeleting;

                if (shouldDelete) {
                    textElement.textContent = currentWord.substring(0, currentCharIndex - 1);
                    currentCharIndex--;
                } else {
                    textElement.textContent = currentWord.substring(0, currentCharIndex + 1);
                    currentCharIndex++;
                }

                let typingSpeed = 100;

                if (!shouldDelete && currentCharIndex === currentWord.length) {
                    // Tunggu sebelum mulai menghapus
                    typingSpeed = 2000;
                    isDeleting = true;
                } else if (shouldDelete && currentCharIndex === 0) {
                    isDeleting = false;
                    currentWordIndex++;
                    if (currentWordIndex === words.length) {
                        currentWordIndex = 0;
                    }
                    typingSpeed = 500;
                }

                setTimeout(typeWriter, typingSpeed);
            }

            // Mulai efek typewriter
            typeWriter();
        });

        // Particles effect
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 80
                },
                color: {
                    value: '#ffffff'
                },
                opacity: {
                    value: 0.2
                },
                size: {
                    value: 3
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#ffffff',
                    opacity: 0.1,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2
                }
            }
        });
    </script>

    <!-- Tambahkan script untuk handling dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan class untuk handling hover state
            const dropdowns = document.querySelectorAll('.group');

            dropdowns.forEach(dropdown => {
                let timeoutId;

                dropdown.addEventListener('mouseenter', () => {
                    clearTimeout(timeoutId);
                    dropdown.classList.add('dropdown-active');
                });

                dropdown.addEventListener('mouseleave', () => {
                    timeoutId = setTimeout(() => {
                        dropdown.classList.remove('dropdown-active');
                    }, 100); // Delay sebelum dropdown menghilang
                });
            });
        });
    </script>

    <!-- Tambahkan script untuk konfirmasi logout -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
         function confirmLogout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out from your account",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0f172a',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    Swal.fire({
                        title: 'Logging out...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Submit logout form
                    document.querySelector('form[action="{{ route('logout') }}"]').submit();
                }
            });
        }

        // Tambahkan efek hover yang lebih smooth
        document.querySelectorAll('.group/item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                const arrow = item.querySelector('.ml-auto');
                arrow.style.transform = 'translateX(0)';
                arrow.style.opacity = '1';
            });

            item.addEventListener('mouseleave', () => {
                const arrow = item.querySelector('.ml-auto');
                arrow.style.transform = 'translateX(-10px)';
                arrow.style.opacity = '0';
            });
        });
    </script>

    <!-- Tambahkan script untuk mouse trail effect -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.interactive-background');
            const trailContainer = document.getElementById('mouse-trail');
            const dots = [];
            const maxDots = 15; // Mengurangi jumlah dots untuk performa lebih baik

            // Mouse trail effect yang lebih responsif
            document.addEventListener('mousemove', function(e) {
                const dot = document.createElement('div');
                dot.className = 'trail-dot';
                dot.style.left = e.clientX + 'px';
                dot.style.top = e.clientY + 'px';
                trailContainer.appendChild(dot);
                dots.push(dot);

                if (dots.length > maxDots) {
                    const removedDot = dots.shift();
                    removedDot.remove();
                }

                // Animate dots dengan efek yang lebih jelas
                dots.forEach((dot, index) => {
                    const scale = 1 - (index / maxDots) *
                        0.7; // Mengurangi pengecilan untuk visibility lebih baik
                    const opacity = 1 - (index / maxDots) * 0.8; // Mengurangi transparency
                    dot.style.transform = `scale(${scale})`;
                    dot.style.opacity = opacity;
                });
            });

            // Floating circles dengan pergerakan yang lebih dinamis
            const circles = document.querySelectorAll('.floating-circle');
            circles.forEach((circle, index) => {
                // Posisi awal random
                circle.style.left = `${Math.random() * 80 + 10}%`; // Membatasi area pergerakan
                circle.style.top = `${Math.random() * 80 + 10}%`; // Membatasi area pergerakan

                // Tambahkan pulse effect
                setInterval(() => {
                    circle.style.transform = `scale(${1 + Math.random() * 0.2})`; // Random pulse
                }, 2000);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addToCart = function(productId) {
                if (event) {
                    event.preventDefault();
                }

                NProgress.start();

                const token = document.querySelector('meta[name="csrf-token"]').content;

                fetch(`/customer/cart/add/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Update cart counter
                            const cartCounter = document.querySelector('.cart-counter');
                            if (cartCounter) {
                                cartCounter.textContent = data.cartCount;
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        NProgress.done();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to add to cart',
                            confirmButtonColor: '#4F46E5'
                        });
                        NProgress.done();
                    });
            };
        });
    </script>

</body>

</html>
