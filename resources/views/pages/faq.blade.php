@extends('layouts.app')

@section('title', 'FAQ - FoodBridge')

@section('content')

<section class="max-w-2xl mx-auto py-8 sm:py-12">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pertanyaan Umum</h1>
        <p class="text-gray-500">Temukan jawaban atas pertanyaan yang sering diajukan.</p>
    </div>

    <div class="space-y-3">
        @php
            $faqs = [
                ['q' => 'Apa itu FoodBridge?', 'a' => 'FoodBridge adalah platform yang menghubungkan restoran dengan makanan berlebih ke individu dan komunitas yang membutuhkan, untuk mengurangi sampah makanan.'],
                ['q' => 'Apakah makanan yang diklaim gratis?', 'a' => 'Ya, semua makanan yang tersedia di FoodBridge dibagikan secara gratis oleh restoran mitra.'],
                ['q' => 'Bagaimana cara mengklaim makanan?', 'a' => 'Cari makanan yang tersedia, klik "Klaim Sekarang", tunggu konfirmasi dari restoran, lalu tunjukkan QR Code saat pengambilan.'],
                ['q' => 'Bagaimana restoran bisa bergabung?', 'a' => 'Restoran dapat mendaftar melalui halaman registrasi khusus restoran, lalu menunggu proses verifikasi oleh admin kami.'],
                ['q' => 'Apakah ada batas waktu pengambilan?', 'a' => 'Ya, setiap makanan memiliki batas waktu ambil yang ditentukan restoran. Jika lewat, klaim akan otomatis kedaluwarsa.'],
            ];
        @endphp

        @foreach ($faqs as $index => $faq)
            <div x-data="{ open: false }" class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <button @click="open = !open" class="w-full flex items-center justify-between text-left px-5 py-4">
                    <span class="font-medium text-gray-900">{{ $faq['q'] }}</span>
                    <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-collapse.duration.250ms class="px-5 pb-4 text-gray-500 text-sm leading-relaxed">
                    {{ $faq['a'] }}
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection