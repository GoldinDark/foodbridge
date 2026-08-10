@extends('layouts.app')

@section('title', 'Restoran Mitra - FoodBridge')

@section('content')

<section class="text-center mb-10">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Restoran Mitra Kami</h1>
    <p class="text-gray-500">Restoran dan UMKM yang telah terverifikasi bergabung dengan FoodBridge.</p>
</section>

@if ($restaurants->count() > 0)
    <div class="grid gap-6 mb-10" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
        @foreach ($restaurants as $restaurant)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-12 h-12 shrink-0 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M5 21V7l8-4v18M13 21V7l6 3v11M9 9v.01M9 12v.01M9 15v.01" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $restaurant->business_name }}</h3>
                        <p class="text-gray-500 text-sm">{{ $restaurant->address }}</p>
                    </div>
                </div>
                <span class="inline-block bg-green-50 text-green-600 text-xs font-medium px-2.5 py-1 rounded-full">
                    {{ $restaurant->foods_count }} makanan tersedia
                </span>
            </div>
        @endforeach
    </div>

    <div>
        {{ $restaurants->links() }}
    </div>
@else
    <div class="text-center py-16 text-gray-400">
        Belum ada restoran terverifikasi saat ini.
    </div>
@endif

@endsection