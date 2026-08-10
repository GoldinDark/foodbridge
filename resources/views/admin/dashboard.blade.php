@extends('layouts.app')

@section('title', 'Dashboard Admin - FoodBridge')

@section('content')

<section class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
    <p class="text-gray-500">Ringkasan monitoring sistem FoodBridge.</p>
</section>

<section class="grid gap-4 mb-10" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));">
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</div>
        <div class="text-gray-500 text-sm">Total User</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="text-2xl font-bold text-gray-900">{{ $stats['total_restaurants'] }}</div>
        <div class="text-gray-500 text-sm">Total Restoran</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5 {{ $stats['pending_restaurants'] > 0 ? 'ring-2 ring-orange-200' : '' }}">
        <div class="text-2xl font-bold text-orange-500">{{ $stats['pending_restaurants'] }}</div>
        <div class="text-gray-500 text-sm">Menunggu Verifikasi</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="text-2xl font-bold text-gray-900">{{ $stats['total_foods'] }}</div>
        <div class="text-gray-500 text-sm">Total Makanan</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="text-2xl font-bold text-gray-900">{{ $stats['total_claims'] }}</div>
        <div class="text-gray-500 text-sm">Total Klaim</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="text-2xl font-bold text-green-600">{{ $stats['completed_claims'] }}</div>
        <div class="text-gray-500 text-sm">Klaim Selesai</div>
    </div>
</section>

@if ($stats['pending_restaurants'] > 0)
    <div class="bg-orange-50 border border-orange-200 rounded-2xl p-5 flex items-center justify-between gap-4">
        <p class="text-orange-700 text-sm">
            Ada <strong>{{ $stats['pending_restaurants'] }} restoran</strong> menunggu verifikasi Anda.
        </p>
        <a href="{{ route('admin.restaurants.index') }}" class="bg-orange-500 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-orange-600 transition whitespace-nowrap">
            Tinjau Sekarang
        </a>
    </div>
@endif

@endsection