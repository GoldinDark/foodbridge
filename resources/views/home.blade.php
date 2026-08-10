@extends('layouts.app')

@section('title', 'FoodBridge - Saving Food, Sharing Hope')

@section('content')

<!-- Hero Section -->
<section class="relative text-center py-14 sm:py-24 px-4 -mx-4 mb-16 overflow-hidden rounded-3xl bg-gradient-to-b from-green-50 via-white to-white">
    <div class="absolute top-10 left-6 w-16 h-16 bg-orange-200/40 rounded-full blur-xl"></div>
    <div class="absolute bottom-6 right-10 w-24 h-24 bg-green-200/40 rounded-full blur-xl"></div>

    <div class="relative">
        <span class="inline-block bg-green-100 text-green-700 text-xs font-medium px-3 py-1 rounded-full mb-4">
            Food Rescue Platform
        </span>

        <h1 class="text-3xl sm:text-5xl font-bold text-gray-900 mb-4 leading-tight">
            Saving Food,<br>
            <span class="text-green-600">Sharing Hope</span>
        </h1>

        <p class="text-gray-500 text-base sm:text-lg max-w-xl mx-auto mb-8">
            Menghubungkan restoran dengan makanan berlebih ke individu dan komunitas yang membutuhkan.
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
            <a href="{{ route('foods.index') }}"
                class="inline-block bg-green-600 text-white px-6 sm:px-10 py-3.5 rounded-full font-medium text-sm sm:text-base whitespace-nowrap hover:bg-green-700 shadow-sm shadow-green-200 transition">
                Cari Makanan Sekarang
            </a>
            @guest
                <a href="{{ route('register') }}"
                    class="inline-block bg-white text-gray-700 border border-gray-300 px-6 sm:px-10 py-3.5 rounded-full font-medium text-sm sm:text-base whitespace-nowrap hover:bg-gray-50 transition">
                    Daftar Gratis
                </a>
            @endguest
        </div>
    </div>
</section>

<!-- Statistik -->
<section class="grid gap-4 mb-20" style="grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
        <div class="w-12 h-12 shrink-0 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
        </div>
        <div>
            <div class="text-2xl font-bold text-gray-900">{{ $stats['total_foods_saved'] }}</div>
            <div class="text-gray-500 text-sm">Porsi Terselamatkan</div>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
        <div class="w-12 h-12 shrink-0 bg-orange-100 text-orange-500 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M5 21V7l8-4v18M13 21V7l6 3v11M9 9v.01M9 12v.01M9 15v.01" />
            </svg>
        </div>
        <div>
            <div class="text-2xl font-bold text-gray-900">{{ $stats['total_restaurants'] }}</div>
            <div class="text-gray-500 text-sm">Restoran Mitra</div>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
        <div class="w-12 h-12 shrink-0 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
        </div>
        <div>
            <div class="text-2xl font-bold text-gray-900">{{ $stats['total_available_foods'] }}</div>
            <div class="text-gray-500 text-sm">Tersedia Sekarang</div>
        </div>
    </div>
</section>

<!-- Cara Kerja -->
<section class="mb-20">
    <div class="text-center mb-10">
        <span class="text-green-600 text-sm font-semibold uppercase tracking-wide">Simpel dan Mudah</span>
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-1">Cara Kerja FoodBridge</h2>
    </div>
    <div class="grid gap-6" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
        <div class="bg-white rounded-2xl border border-gray-100 p-6 text-center hover:shadow-md transition">
            <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">1. Cari Makanan</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Temukan makanan berlebih dari restoran terdekat Anda.</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 text-center hover:shadow-md transition">
            <div class="w-14 h-14 bg-orange-100 text-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">2. Klaim</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Klaim makanan yang Anda inginkan, tunggu konfirmasi restoran.</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 text-center hover:shadow-md transition">
            <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">3. Ambil dan Nikmati</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Tunjukkan QR Code Anda saat mengambil makanan.</p>
        </div>
    </div>
</section>

<!-- Makanan Terbaru -->
@if ($latestFoods->count() > 0)
<section>
    <div class="flex items-center justify-between mb-6 gap-2">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Makanan Tersedia Sekarang</h2>
        <a href="{{ route('foods.index') }}" class="text-green-600 text-sm font-medium hover:underline whitespace-nowrap">Lihat Semua &rarr;</a>
    </div>

    <div class="grid gap-6" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
        @foreach ($latestFoods as $food)
            <a href="{{ route('foods.show', $food) }}" class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition">
                <div class="overflow-hidden">
                    @if ($food->photo)
                        <img src="{{ Storage::url($food->photo) }}" alt="{{ $food->name }}" class="w-full h-44 object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-44 bg-gray-100 flex items-center justify-center text-gray-300 text-4xl">🍽️</div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-1 group-hover:text-green-600 transition">{{ $food->name }}</h3>
                    <p class="text-gray-500 text-sm mb-3">{{ $food->restaurant->business_name }}</p>
                    <span class="inline-block bg-green-50 text-green-600 text-xs font-medium px-2.5 py-1 rounded-full">
                        {{ $food->quantity }} porsi tersisa
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

@endsection