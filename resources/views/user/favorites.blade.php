@extends('layouts.app')

@section('title', 'Makanan Favorit - FoodBridge')

@section('content')

<section class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Makanan Favorit</h1>
    <p class="text-gray-500">Makanan yang sudah Anda tandai sebagai favorit.</p>
</section>

@if ($favorites->count() > 0)
    <div class="grid gap-6" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
        @foreach ($favorites as $food)
            <a href="{{ route('foods.show', $food) }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                @if ($food->photo)
                    <img src="{{ Storage::url($food->photo) }}" alt="{{ $food->name }}" class="w-full h-40 object-cover">
                @else
                    <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-300 text-3xl">🍽️</div>
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-1">{{ $food->name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $food->restaurant->business_name }}</p>
                </div>
            </a>
        @endforeach
    </div>
    <div class="mt-6">{{ $favorites->links() }}</div>
@else
    <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center text-gray-400">
        Belum ada makanan favorit. <a href="{{ route('foods.index') }}" class="text-green-600 hover:underline">Cari makanan sekarang</a>
    </div>
@endif

@endsection