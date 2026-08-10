@extends('layouts.app')

@section('title', 'Tentang Kami - FoodBridge')

@section('content')

<section class="max-w-3xl mx-auto text-center py-8 sm:py-12">
    <span class="inline-block bg-green-100 text-green-700 text-xs font-medium px-3 py-1 rounded-full mb-4">
        Tentang Kami
    </span>
    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
        Mengurangi Sampah Makanan,<br class="hidden sm:block"> Menyalurkan Harapan
    </h1>
    <p class="text-gray-500 leading-relaxed">
        FoodBridge lahir dari keprihatinan akan besarnya jumlah makanan layak konsumsi yang terbuang sia-sia setiap hari,
        sementara di sisi lain masih banyak individu dan komunitas yang membutuhkan akses pangan.
    </p>
</section>

<section class="grid gap-6 mb-16" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
        </div>
        <h3 class="font-semibold text-gray-900 mb-2">Misi Kami</h3>
        <p class="text-gray-500 text-sm leading-relaxed">
            Menjembatani restoran, hotel, bakery, dan UMKM dengan komunitas yang membutuhkan, secara cepat dan aman.
        </p>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="w-12 h-12 bg-orange-100 text-orange-500 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h3 class="font-semibold text-gray-900 mb-2">Nilai Kami</h3>
        <p class="text-gray-500 text-sm leading-relaxed">
            Transparansi, kepercayaan, dan dampak nyata — setiap klaim tercatat, setiap restoran terverifikasi.
        </p>
    </div>
</section>

<section class="text-center bg-green-600 rounded-3xl py-10 px-6">
    <h2 class="text-xl sm:text-2xl font-bold text-white mb-3">Ingin Bergabung dengan Kami?</h2>
    <p class="text-green-50 mb-6 text-sm sm:text-base">Jadilah bagian dari gerakan mengurangi sampah makanan.</p>
    <a href="{{ route('register') }}" class="inline-block bg-white text-green-600 px-8 py-3 rounded-full font-medium hover:bg-green-50 transition">
        Daftar Sekarang
    </a>
</section>

@endsection