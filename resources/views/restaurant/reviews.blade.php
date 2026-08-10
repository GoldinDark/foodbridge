@extends('layouts.app')

@section('title', 'Review Pelanggan - FoodBridge')

@section('content')

<section class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Review Pelanggan</h1>
    <p class="text-gray-500">Kelola dan balas review dari pelanggan Anda.</p>
</section>

@forelse ($reviews as $review)
    <div class="bg-white rounded-2xl border border-gray-100 p-5 mb-4">
        <div class="flex items-start justify-between gap-4 mb-2">
            <div>
                <p class="font-medium text-gray-900">{{ $review->claim->user->name }}</p>
                <p class="text-gray-400 text-xs">{{ $review->claim->food->name }} &middot; {{ $review->created_at->diffForHumans() }}</p>
            </div>
            <div class="flex gap-0.5">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-orange-400 fill-orange-400' : 'text-gray-300 fill-transparent' }}"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                    </svg>
                @endfor
            </div>
        </div>

        @if ($review->comment)
            <p class="text-gray-700 text-sm mb-3">{{ $review->comment }}</p>
        @endif

        @if ($review->restaurant_reply)
            <div class="bg-gray-50 rounded-xl p-3 mt-2">
                <p class="text-xs font-medium text-gray-500 mb-1">Balasan Anda:</p>
                <p class="text-gray-700 text-sm">{{ $review->restaurant_reply }}</p>
            </div>
        @else
            <form method="POST" action="{{ route('restaurant.reviews.reply', $review) }}" class="mt-2">
                @csrf
                <textarea name="restaurant_reply" rows="2" placeholder="Tulis balasan..."
                    class="w-full rounded-xl border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 mb-2"></textarea>
                <button type="submit" class="bg-green-600 text-white text-sm font-medium px-4 py-1.5 rounded-lg hover:bg-green-700 transition">
                    Kirim Balasan
                </button>
            </form>
        @endif
    </div>
@empty
    <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center text-gray-400">
        Belum ada review untuk restoran Anda.
    </div>
@endforelse

<div>{{ $reviews->links() }}</div>

@endsection