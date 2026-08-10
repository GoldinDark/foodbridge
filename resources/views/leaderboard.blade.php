@extends('layouts.app')

@section('title', 'Leaderboard - FoodBridge')

@section('content')

<section class="text-center mb-10">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">🏆 Papan Peringkat</h1>
    <p class="text-gray-500">Para penyelamat makanan paling aktif di FoodBridge.</p>
</section>

<div class="max-w-2xl mx-auto space-y-2">
    @forelse ($topUsers as $index => $user)
        <div class="bg-white rounded-2xl border border-gray-100 p-4 flex items-center gap-4 {{ $index < 3 ? 'ring-2 ring-orange-200' : '' }}">
            <div class="w-8 text-center font-bold {{ $index === 0 ? 'text-orange-400 text-xl' : ($index < 3 ? 'text-gray-400' : 'text-gray-300') }}">
                {{ $index + 1 }}
            </div>
            <div class="flex-1">
                <p class="font-medium text-gray-900">{{ $user->name }}</p>
            </div>
            <div class="text-green-600 font-semibold text-sm">
                {{ $user->claims_count }} klaim
            </div>
        </div>
    @empty
        <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center text-gray-400">
            Belum ada data peringkat.
        </div>
    @endforelse
</div>

@endsection