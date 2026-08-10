@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan - FoodBridge')

@section('content')

<div class="text-center py-16">
    <div class="text-6xl mb-4">🔍</div>
    <h1 class="text-3xl font-bold text-gray-900 mb-2">404 - Halaman Tidak Ditemukan</h1>
    <p class="text-gray-500 mb-8">Maaf, halaman yang Anda cari tidak dapat ditemukan.</p>
    <a href="{{ route('home') }}" class="inline-block bg-green-600 text-white px-6 py-3 rounded-full font-medium hover:bg-green-700 transition">
        Kembali ke Beranda
    </a>
</div>

@endsection