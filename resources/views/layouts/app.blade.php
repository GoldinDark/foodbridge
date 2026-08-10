<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodBridge')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@stack('scripts')
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">

    <header class="bg-white border-b border-gray-200 sticky top-0 z-50" x-data="{ menuOpen: false }">
        <nav class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-bold text-green-600">
                Food<span class="text-orange-500">Bridge</span>
            </a>

            <!-- Menu Desktop (tersembunyi di layar kecil) -->
            <div class="hidden md:flex items-center gap-4">
                <a href="{{ route('foods.index') }}" class="text-gray-600 hover:text-green-600">Cari Makanan</a>
                <a href="{{ route('restaurants.index') }}" class="text-gray-600 hover:text-green-600">Restoran</a>
                <a href="{{ route('about') }}" class="text-gray-600 hover:text-green-600">Tentang</a>
                <a href="{{ route('faq') }}" class="text-gray-600 hover:text-green-600">FAQ</a>
                <a href="{{ route('leaderboard') }}" class="text-gray-600 hover:text-green-600">Leaderboard</a>

                @auth
                    @if (auth()->user()->hasRole('restaurant'))
                        <a href="{{ route('restaurant.dashboard') }}" class="text-gray-600 hover:text-green-600">Dashboard</a>
                        <a href="{{ route('restaurant.reviews.index') }}" class="text-gray-600 hover:text-green-600">Review</a>
                    @elseif (auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-green-600">Dashboard</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-green-600">Dashboard</a>
                        <a href="{{ route('user.favorites.index') }}" class="text-gray-600 hover:text-green-600">Favorit</a>
                    @endif

                    <span class="text-gray-400">|</span>
                    <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-500 hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600">Login</a>
                    <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-full text-sm hover:bg-green-700">Daftar</a>
                @endauth
            </div>

            <!-- Tombol Hamburger (cuma tampil di layar kecil) -->
            <button @click="menuOpen = !menuOpen" class="md:hidden p-2 text-gray-600">
                <svg x-show="!menuOpen"
                     x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-300"
                     x-transition:enter-start="opacity-0 rotate-90"
                     x-transition:enter-end="opacity-100 rotate-0"
                     x-transition:leave="transition ease-in duration-150"
                     class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="menuOpen"
                     x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-300"
                     x-transition:enter-start="opacity-0 -rotate-90"
                     x-transition:enter-end="opacity-100 rotate-0"
                     x-transition:leave="transition ease-in duration-150"
                     class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </nav>

        <!-- Menu Mobile (dropdown, membuka ke bawah pakai x-collapse) -->
        <div x-show="menuOpen"
             x-collapse.duration.300ms
             class="md:hidden border-t border-gray-200 px-4 py-3 space-y-3">
            <a href="{{ route('foods.index') }}" class="block text-gray-600 hover:text-green-600">Cari Makanan</a>
            <a href="{{ route('restaurants.index') }}" class="block text-gray-600 hover:text-green-600">Restoran</a>
            <a href="{{ route('about') }}" class="block text-gray-600 hover:text-green-600">Tentang</a>
            <a href="{{ route('faq') }}" class="block text-gray-600 hover:text-green-600">FAQ</a>

            @auth
                @if (auth()->user()->hasRole('restaurant'))
                    <a href="{{ route('restaurant.dashboard') }}" class="block text-gray-600 hover:text-green-600">Dashboard</a>
                    <a href="{{ route('restaurant.reviews.index') }}" class="text-gray-600 hover:text-green-600">Review</a>
                @elseif (auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin.dashboard') }}" class="block text-gray-600 hover:text-green-600">Dashboard</a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="block text-gray-600 hover:text-green-600">Dashboard</a>
                    <a href="{{ route('user.favorites.index') }}" class="text-gray-600 hover:text-green-600">Favorit</a>
                @endif

                <div class="text-sm text-gray-600 pt-2 border-t border-gray-100">{{ auth()->user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-gray-600 hover:text-green-600">Login</a>
                <a href="{{ route('register') }}" class="block bg-green-600 text-white px-4 py-2 rounded-full text-sm text-center w-fit hover:bg-green-700">Daftar</a>
            @endauth
        </div>
    </header>

    <main class="flex-1 max-w-6xl mx-auto px-4 py-6 sm:py-8 w-full">

        @if (session('success'))
            <div class="bg-green-50 border border-green-300 text-green-700 rounded-xl px-4 py-3 mb-6 text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-700 rounded-xl px-4 py-3 mb-6 text-sm sm:text-base">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </main>

    <footer class="bg-white border-t border-gray-200 py-6 text-center text-sm text-gray-500 px-4">
        &copy; {{ date('Y') }} FoodBridge — Saving Food, Sharing Hope
    </footer>

</body>
</html>