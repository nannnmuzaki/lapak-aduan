<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full antialiased">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <title>{{ $title ?? 'Lapak Pengaduan Kabupaten Banyumas' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans text-gray-950 bg-gray-50 dark:bg-gray-950 dark:text-white" x-data="{ mobileMenuOpen: false }">

    <nav class="sticky top-0 z-50 w-full border-b border-gray-200 bg-white/80 backdrop-blur-xl dark:bg-gray-900/80 dark:border-gray-800">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                <div class="flex">
                    <div class="flex items-center shrink-0">
                        <a wire:navigate href="{{ route('home') }}" class="flex items-center gap-1 focus:outline-none">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="object-contain size-11">
                            <div class="flex flex-col items-start leading-4 gap-1 text-base font-bold dark:text-white/90">
                                <span>Lapak Aduan</span>
                                <span class="hidden sm:block">Kabupaten Banyumas</span>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Desktop Navigation -->
                    <div class="hidden lg:ml-8 lg:flex lg:space-x-1">
                        <a href="{{ route('page.buat-pengaduan') }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('page.buat-pengaduan') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950 dark:text-primary-400' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100' }}">
                            Buat Pengaduan
                        </a>

                        <a wire:navigate href="{{ route('page.alur') }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('page.alur') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950 dark:text-primary-400' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100' }}">
                            Alur
                        </a>

                        <a wire:navigate href="{{ route('page.daftar-opd') }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('page.daftar-opd') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950 dark:text-primary-400' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100' }}">
                            Daftar OPD
                        </a>

                        <a wire:navigate href="{{ route('page.daftar-pengaduan') }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('page.daftar-pengaduan') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950 dark:text-primary-400' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100' }}">
                            Semua Pengaduan
                        </a>

                        @auth
                            <a wire:navigate href="{{ route('page.pengaduan-saya') }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('page.pengaduan-saya') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950 dark:text-primary-400' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100' }}">
                                Pengaduan Saya
                            </a>
                        @endauth

                        <a wire:navigate href="{{ route('page.statistik') }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('page.statistik') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950 dark:text-primary-400' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100' }}">
                            Statistik
                        </a>
                    </div>
                </div>

                <div class="flex items-center gap-x-2">
                    <!-- Theme Toggle -->
                    <button type="button"
                        @click="$dispatch('theme-changed', $store.theme === 'dark' ? 'light' : 'dark')"
                        class="p-2 text-gray-600 transition-colors rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            x-show="$store.theme === 'light'" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            x-show="$store.theme === 'dark'" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>

                    @auth
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open"
                                class="flex items-center gap-2 p-1 transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <div class="flex items-center justify-center overflow-hidden rounded-full size-8 bg-gray-200 dark:bg-gray-700">
                                    @if(Auth::user()->avatar_url)
                                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="object-cover size-full">
                                    @else
                                        <span class="text-sm font-medium text-primary-600 dark:text-primary-400">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                        </span>
                                    @endif
                                </div>
                                <svg class="hidden w-4 h-4 text-gray-600 sm:block dark:text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 w-56 mt-2 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-800"
                                x-cloak>

                                <!-- User Info -->
                                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-800">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-600 truncate dark:text-gray-400">{{ Auth::user()->email }}</p>
                                </div>

                                <!-- Menu Items -->
                                <div class="py-1">
                                    @if(Auth::user()->hasRole(['admin', 'staff']))
                                        <a href="{{ filament()->getUrl() }}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                                            <svg class="w-4 h-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            Admin Panel
                                        </a>
                                    @endif

                                    <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center w-full px-4 py-2 text-sm text-left text-red-600 transition-colors hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950">
                                            <svg class="w-4 h-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="hidden sm:flex items-center gap-2">
                            <a href="/main/login"
                                class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                                Masuk
                            </a>
                        </div>
                    @endauth

                    <!-- Mobile menu button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                        class="inline-flex items-center justify-center p-2 text-gray-600 transition-colors rounded-lg lg:hidden hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-show="!mobileMenuOpen">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-show="mobileMenuOpen" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Drawer -->
    <div x-show="mobileMenuOpen" 
         @click="mobileMenuOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm lg:hidden" 
         x-cloak>
    </div>

    <div x-show="mobileMenuOpen"
         @click.away="mobileMenuOpen = false"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="fixed inset-y-0 left-0 z-50 w-64 overflow-y-auto bg-white border-r border-gray-200 lg:hidden dark:bg-gray-900 dark:border-gray-800"
         x-cloak>
        
        <!-- Drawer Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-800">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="object-contain size-8">
                <span class="text-sm font-bold dark:text-white">Lapak Aduan</span>
            </div>
            <button @click="mobileMenuOpen = false" 
                    class="p-1 text-gray-600 transition-colors rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Drawer Navigation -->
        <nav class="p-4 space-y-1">
            <a href="{{ route('page.buat-pengaduan') }}"
                @click="mobileMenuOpen = false"
                class="flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('page.buat-pengaduan') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950 dark:text-primary-400' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Pengaduan
            </a>

            <a wire:navigate href="{{ route('page.alur') }}"
                @click="mobileMenuOpen = false"
                class="flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('page.alur') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950 dark:text-primary-400' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Alur
            </a>

            <a wire:navigate href="{{ route('page.daftar-opd') }}"
                @click="mobileMenuOpen = false"
                class="flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('page.daftar-opd') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950 dark:text-primary-400' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                Daftar OPD
            </a>

            <a wire:navigate href="{{ route('page.daftar-pengaduan') }}"
                @click="mobileMenuOpen = false"
                class="flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('page.daftar-pengaduan') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950 dark:text-primary-400' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Semua Pengaduan
            </a>

            @auth
                <a wire:navigate href="{{ route('page.pengaduan-saya') }}"
                    @click="mobileMenuOpen = false"
                    class="flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('page.pengaduan-saya') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950 dark:text-primary-400' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Pengaduan Saya
                </a>
            @endauth

            <a wire:navigate href="{{ route('page.statistik') }}"
                @click="mobileMenuOpen = false"
                class="flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('page.statistik') ? 'bg-primary-50 text-primary-600 dark:bg-primary-950 dark:text-primary-400' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Statistik
            </a>

            @guest
                <div class="pt-4 mt-4 space-y-1 border-t border-gray-200 dark:border-gray-800">
                    <a href="/admin/login"
                        @click="mobileMenuOpen = false"
                        class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 transition-colors rounded-lg hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk
                    </a>
                    <a href="/admin/register"
                        @click="mobileMenuOpen = false"
                        class="flex items-center px-3 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-primary-600 hover:bg-primary-700">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Daftar
                    </a>
                </div>
            @endguest
        </nav>
    </div>

    <main class="py-10">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    <script>
        // Initialize theme store
        function initializeTheme() {
            const theme = localStorage.getItem('theme') ??
                getComputedStyle(document.documentElement).getPropertyValue('--default-theme-mode');

            const resolvedTheme = theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)
                ? 'dark'
                : 'light';

            // Apply theme immediately
            if (resolvedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }

            // Set Alpine store if it exists
            if (window.Alpine) {
                window.Alpine.store('theme', resolvedTheme);
            }
        }

        document.addEventListener('alpine:init', () => {
            // Initialize theme on first load
            initializeTheme();

            window.addEventListener('theme-changed', (event) => {
                let theme = event.detail;
                localStorage.setItem('theme', theme);
                if (theme === 'system') {
                    theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }
                window.Alpine.store('theme', theme);
            });

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (event) => {
                if (localStorage.getItem('theme') === 'system') {
                    window.Alpine.store('theme', event.matches ? 'dark' : 'light');
                }
            });

            window.Alpine.effect(() => {
                const theme = window.Alpine.store('theme');
                theme === 'dark'
                    ? document.documentElement.classList.add('dark')
                    : document.documentElement.classList.remove('dark');
            });
        });

        // Re-initialize theme on Livewire navigation
        document.addEventListener('livewire:navigated', () => {
            initializeTheme();
        });

        // Also initialize immediately on page load (before Alpine loads)
        initializeTheme();
    </script>
</body>

</html>