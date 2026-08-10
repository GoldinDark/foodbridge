@extends('layouts.app')

@section('title', 'Dashboard - FoodBridge')

@section('content')

<section class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Halo, {{ auth()->user()->name }} 👋</h1>
    <p class="text-gray-500">Berikut ringkasan aktivitas Anda di FoodBridge.</p>
</section>

<!-- Statistik -->
<section class="grid gap-4 mb-10" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="text-2xl font-bold text-gray-900">{{ $stats['total_claims'] }}</div>
        <div class="text-gray-500 text-sm">Total Klaim</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="text-2xl font-bold text-green-600">{{ $stats['completed_claims'] }}</div>
        <div class="text-gray-500 text-sm">Klaim Selesai</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="text-2xl font-bold text-orange-500">{{ $stats['pending_claims'] }}</div>
        <div class="text-gray-500 text-sm">Sedang Berlangsung</div>
    </div>
</section>

<div class="grid gap-8 lg:grid-cols-3">

    <!-- Riwayat Klaim -->
    <div class="lg:col-span-2">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Riwayat Klaim Terbaru</h2>

        @forelse ($claims as $claim)
            <a href="{{ route('claims.show', $claim) }}" class="block bg-white rounded-2xl border border-gray-100 p-4 mb-3 hover:shadow-md transition">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="font-medium text-gray-900">{{ $claim->food->name }}</p>
                        <p class="text-gray-500 text-sm">{{ $claim->food->restaurant->business_name }}</p>
                        <p class="text-gray-400 text-xs mt-1">{{ $claim->created_at->diffForHumans() }}</p>
                    </div>
                    <span @class([
                        'text-xs font-medium px-3 py-1 rounded-full whitespace-nowrap',
                        'bg-yellow-50 text-yellow-600' => $claim->status === 'pending',
                        'bg-blue-50 text-blue-600' => $claim->status === 'confirmed',
                        'bg-green-50 text-green-600' => $claim->status === 'completed',
                        'bg-red-50 text-red-600' => $claim->status === 'rejected',
                        'bg-gray-100 text-gray-500' => $claim->status === 'expired',
                    ])>
                        {{ ucfirst($claim->status) }}
                    </span>
                </div>
            </a>
        @empty
            <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center text-gray-400">
                Anda belum pernah mengklaim makanan.
                <a href="{{ route('foods.index') }}" class="text-green-600 hover:underline">Cari makanan sekarang</a>
            </div>
        @endforelse
    </div>

    <!-- Badge -->
    <div>
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Badge Anda</h2>
        <div class="bg-white rounded-2xl border border-gray-100 p-5">
            @forelse ($badges as $badge)
                <div class="flex items-center gap-3 mb-4 last:mb-0">
                    <div class="w-10 h-10 shrink-0 bg-orange-100 text-orange-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 text-sm">{{ $badge->name }}</p>
                        <p class="text-gray-400 text-xs">{{ $badge->pivot->earned_at ? \Carbon\Carbon::parse($badge->pivot->earned_at)->diffForHumans() : '' }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-sm text-center py-4">Belum ada badge. Terus berkontribusi!</p>
            @endforelse
        </div>
    </div>

</div>

@endsection