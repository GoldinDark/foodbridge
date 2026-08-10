@extends('layouts.app')

@section('title', 'Detail Klaim - FoodBridge')

@section('content')

<div class="max-w-md mx-auto">

    <a href="{{ route('user.dashboard') }}" class="text-gray-500 text-sm hover:text-green-600 inline-block mb-4">&larr; Kembali</a>

    <div class="bg-white rounded-2xl border border-gray-100 p-6 text-center">
        <h1 class="text-xl font-bold text-gray-900 mb-1">{{ $claim->food->name }}</h1>
        <p class="text-gray-500 text-sm mb-6">{{ $claim->food->restaurant->business_name }}</p>

        @if ($claim->status === 'confirmed')
            <div class="bg-green-50 rounded-2xl p-6 mb-4">
                <p class="text-green-700 text-sm font-medium mb-4">Tunjukkan QR Code ini saat mengambil makanan</p>
                <div class="bg-white p-4 rounded-xl inline-block">
                    {!! QrCode::size(200)->generate($claim->qr_code) !!}
                </div>
            </div>
            <p class="text-gray-400 text-xs">Kode: {{ $claim->qr_code }}</p>

        @elseif ($claim->status === 'pending')
            <div class="bg-yellow-50 text-yellow-700 rounded-2xl p-6 text-sm">
                Menunggu konfirmasi dari restoran. Silakan cek kembali beberapa saat lagi.
            </div>

        @elseif ($claim->status === 'completed')
    <div class="bg-blue-50 text-blue-700 rounded-2xl p-6 text-sm mb-4">
        Klaim ini sudah selesai. Terima kasih sudah berpartisipasi menyelamatkan makanan! 🎉
    </div>

    @if ($claim->review)
    <div class="bg-gray-50 rounded-2xl p-6 text-left">
        <p class="text-sm text-gray-500 mb-2">Review Anda:</p>
        <div class="flex gap-1 mb-2">
            @for ($i = 1; $i <= 5; $i++)
                <svg class="w-6 h-6 {{ $i <= $claim->review->rating ? 'text-orange-400 fill-orange-400' : 'text-gray-300 fill-transparent' }}"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                </svg>
            @endfor
        </div>
        @if ($claim->review->comment)
            <p class="text-gray-700 text-sm">{{ $claim->review->comment }}</p>
        @endif

        @if ($claim->review->restaurant_reply)
            <div class="mt-4 pt-4 border-t border-gray-200">
                <p class="text-xs font-medium text-gray-500 mb-1">Balasan dari {{ $claim->food->restaurant->business_name }}:</p>
                <p class="text-gray-700 text-sm">{{ $claim->review->restaurant_reply }}</p>
            </div>
        @endif
    </div>
@else
        <div x-data="{ rating: 0, hover: 0 }" class="bg-gray-50 rounded-2xl p-6 text-left">
    <p class="text-sm font-medium text-gray-900 mb-3">Beri Rating untuk Pengalaman Ini</p>
    <form method="POST" action="{{ route('reviews.store', $claim) }}">
        @csrf
        <div class="flex gap-1 mb-4">
            @for ($i = 1; $i <= 5; $i++)
                <button type="button" @click="rating = {{ $i }}" @mouseenter="hover = {{ $i }}" @mouseleave="hover = 0" class="transition">
                    <svg class="w-9 h-9"
                        :class="(hover || rating) >= {{ $i }} ? 'text-orange-400 fill-orange-400' : 'text-gray-300 fill-transparent'"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                    </svg>
                </button>
            @endfor
        </div>
        <input type="hidden" name="rating" x-model="rating">
        <textarea name="comment" rows="3" placeholder="Ceritakan pengalaman Anda (opsional)"
            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 mb-3"></textarea>
        <button type="submit" :disabled="rating === 0"
            :class="rating === 0 ? 'opacity-50 cursor-not-allowed' : ''"
            class="w-full bg-green-600 text-white font-medium py-2.5 rounded-xl hover:bg-green-700 transition">
            Kirim Review
        </button>
    </form>
</div>
    @endif

        @elseif ($claim->status === 'rejected')
            <div class="bg-red-50 text-red-700 rounded-2xl p-6 text-sm">
                Maaf, klaim ini ditolak oleh restoran.
                @if ($claim->rejection_reason)
                    <p class="mt-2 text-xs">Alasan: {{ $claim->rejection_reason }}</p>
                @endif
            </div>
        @endif
    </div>

</div>

@endsection