@extends('layouts.app')

@section('title', 'Daftar Makanan - FoodBridge')

@section('content')

<section class="mb-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">Daftar Makanan Tersedia</h1>
    <p class="text-gray-500">Temukan makanan berlebih dari restoran mitra terdekat.</p>
</section>

<form method="GET" action="{{ route('foods.index') }}" class="bg-white rounded-2xl border border-gray-100 p-4 mb-8 grid gap-3 sm:grid-cols-4">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama makanan..."
        class="sm:col-span-2 rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">

    <select name="category" class="rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
        <option value="">Semua Kategori</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <select name="sort" class="rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
        <option value="latest" {{ request('sort') !== 'deadline' ? 'selected' : '' }}>Terbaru</option>
        <option value="deadline" {{ request('sort') === 'deadline' ? 'selected' : '' }}>Batas Waktu Terdekat</option>
    </select>

    <button type="submit" class="sm:col-span-4 bg-green-600 text-white font-medium py-2.5 rounded-xl hover:bg-green-700 transition">
        Terapkan Filter
    </button>
</form>

@if ($foods->count() > 0)
    <div class="grid gap-6" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
        @foreach ($foods as $food)
            <a href="{{ route('foods.show', $food) }}" class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition">
                <div class="overflow-hidden">
                    @if ($food->photo)
                        <img src="{{ Storage::url($food->photo) }}" alt="{{ $food->name }}" class="w-full h-44 object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-44 bg-gray-100 flex items-center justify-center text-gray-300 text-4xl">🍽️</div>
                    @endif
                </div>
                <div class="p-4">
                    <span class="text-xs text-gray-400">{{ $food->category->name }}</span>
                    <h3 class="font-semibold text-gray-900 mb-1 group-hover:text-green-600 transition">{{ $food->name }}</h3>
                    <p class="text-gray-500 text-sm mb-3">{{ $food->restaurant->business_name }}</p>
                    <div class="flex items-center justify-between">
                        <span class="inline-block bg-green-50 text-green-600 text-xs font-medium px-2.5 py-1 rounded-full">
                            {{ $food->quantity }} porsi tersisa
                        </span>
                        <span class="text-gray-400 text-xs">{{ $food->pickup_deadline->diffForHumans() }}</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $foods->links() }}
    </div>
@else
    <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center text-gray-400">
        <p class="text-lg mb-1">Tidak ada makanan yang ditemukan</p>
        <p class="text-sm">Coba ubah kata kunci atau filter pencarian Anda.</p>
    </div>
@endif

@endsection