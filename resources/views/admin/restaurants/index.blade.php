@extends('layouts.app')

@section('title', 'Verifikasi Restoran - FoodBridge')

@section('content')

<section class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Verifikasi Restoran</h1>
    <p class="text-gray-500">Daftar restoran yang menunggu persetujuan.</p>
</section>

@forelse ($restaurants as $restaurant)
    <div class="bg-white rounded-2xl border border-gray-100 p-5 mb-4">
        <div class="flex items-start justify-between gap-4 mb-4">
            <div>
                <h3 class="font-semibold text-gray-900">{{ $restaurant->business_name }}</h3>
                <p class="text-gray-500 text-sm">{{ $restaurant->user->email }}</p>
                <p class="text-gray-500 text-sm">{{ $restaurant->address }}</p>
                @if ($restaurant->business_document)
                <a href="{{ route('admin.restaurants.document', $restaurant) }}" target="_blank" class="text-green-600 text-sm hover:underline inline-block mt-1">
                Lihat Dokumen
                </a>
            @endif
            </div>
            <span class="bg-yellow-50 text-yellow-600 text-xs font-medium px-3 py-1 rounded-full whitespace-nowrap">
                Menunggu
            </span>
        </div>
        <div class="flex gap-2">
            <form method="POST" action="{{ route('admin.restaurants.verify', $restaurant) }}" class="flex-1">
                @csrf
                <button type="submit" class="w-full bg-green-600 text-white text-sm font-medium py-2 rounded-xl hover:bg-green-700 transition">
                    Verifikasi
                </button>
            </form>
            <form method="POST" action="{{ route('admin.restaurants.reject', $restaurant) }}" class="flex-1">
                @csrf
                <button type="submit" class="w-full bg-white text-red-500 border border-red-200 text-sm font-medium py-2 rounded-xl hover:bg-red-50 transition">
                    Tolak
                </button>
            </form>
        </div>
    </div>
@empty
    <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center text-gray-400">
        Tidak ada restoran yang menunggu verifikasi.
    </div>
@endforelse

<div>{{ $restaurants->links() }}</div>

@endsection