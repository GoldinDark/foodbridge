@extends('layouts.app')

@section('title', 'Dashboard Restaurant - FoodBridge')

@section('content')

<div x-data="{
        claims: {{ Illuminate\Support\Js::from($pendingClaimsJson) }},
        unreadCount: {{ $unreadCount }},
        startPolling() {
            setInterval(() => {
                fetch('{{ route('restaurant.poll') }}')
                    .then(response => response.json())
                    .then(data => {
                        this.claims = data.pending_claims;
                        this.unreadCount = data.unread_count;
                    });
            }, 8000);
        }
    }"
    x-init="startPolling()">

    <section class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard Restaurant</h1>
        <p class="text-gray-500">Selamat datang, {{ auth()->user()->name }}</p>
    </section>

    <div class="grid gap-8 lg:grid-cols-3 mb-10">

        <!-- Klaim Masuk -->
        <div class="lg:col-span-2">
            <div class="flex items-center gap-2 mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Klaim Masuk</h2>
                <span x-show="claims.length > 0" x-cloak
                    class="bg-orange-500 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center"
                    x-text="claims.length"></span>
            </div>

            <template x-if="claims.length === 0">
                <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center text-gray-400">
                    Tidak ada klaim yang menunggu konfirmasi.
                </div>
            </template>

            <template x-for="claim in claims" :key="claim.id">
                <div class="bg-white rounded-2xl border border-gray-100 p-4 mb-3">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div>
                            <p class="font-medium text-gray-900" x-text="claim.food_name"></p>
                            <p class="text-gray-500 text-sm" x-text="'Diklaim oleh ' + claim.user_name"></p>
                            <p class="text-gray-400 text-xs mt-1" x-text="claim.created_at"></p>
                        </div>
                        <span class="bg-yellow-50 text-yellow-600 text-xs font-medium px-3 py-1 rounded-full whitespace-nowrap">
                            Menunggu
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <form :action="claim.accept_url" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-green-600 text-white text-sm font-medium py-2 rounded-xl hover:bg-green-700 transition">
                                Terima
                            </button>
                        </form>
                        <form :action="claim.reject_url" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-white text-red-500 border border-red-200 text-sm font-medium py-2 rounded-xl hover:bg-red-50 transition">
                                Tolak
                            </button>
                        </form>
                    </div>
                </div>
            </template>
        </div>

        <!-- Notifikasi -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Notifikasi</h2>
                <span x-show="unreadCount > 0" x-cloak
                    class="bg-red-500 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center"
                    x-text="unreadCount"></span>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-4 space-y-3">
                @forelse ($notifications as $notification)
                    <div class="text-sm {{ $notification->read_at ? 'text-gray-400' : 'text-gray-700 font-medium' }}">
                        <p>{{ $notification->data['message'] }}</p>
                        <p class="text-gray-400 text-xs font-normal mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm text-center py-4">Belum ada notifikasi.</p>
                @endforelse
            </div>
        </div>

    </div>

    <section class="mb-10" x-data="qrScanner()">
    <h2 class="text-lg font-semibold text-gray-900 mb-4">Verifikasi Pengambilan (Scan QR)</h2>

    <div class="bg-white rounded-2xl border border-gray-100 p-6 max-w-xl">

        <div x-show="!scanning" class="text-center">
            <button @click="startScan()" type="button"
                class="bg-green-600 text-white font-medium px-6 py-3 rounded-xl hover:bg-green-700 transition">
                📷 Mulai Scan QR Code
            </button>
        </div>

        <div x-show="scanning" x-cloak>
            <div id="qr-reader" class="rounded-xl overflow-hidden"></div>
            <button @click="stopScan()" type="button" class="mt-3 text-sm text-red-500 hover:underline">
                Batalkan Scan
            </button>
        </div>

        <form method="POST" action="{{ route('restaurant.verify-qr') }}" x-ref="verifyForm" class="hidden">
            @csrf
            <input type="text" name="qr_code" x-ref="qrInput">
        </form>

        <div class="mt-4 pt-4 border-t border-gray-100">
            <p class="text-gray-400 text-xs mb-2">Atau masukkan kode secara manual:</p>
            <form method="POST" action="{{ route('restaurant.verify-qr') }}" class="flex flex-col sm:flex-row gap-3">
                @csrf
                <input type="text" name="qr_code" placeholder="Masukkan kode QR"
                    class="flex-1 rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                <button type="submit" class="bg-gray-100 text-gray-700 font-medium px-6 py-2.5 rounded-xl hover:bg-gray-200 transition whitespace-nowrap text-sm">
                    Verifikasi Manual
                </button>
            </form>
        </div>

    </div>
</section>

    <!-- Form Upload Makanan -->
    <section>
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Upload Makanan Baru</h2>

        <form method="POST" action="{{ route('restaurant.foods.store') }}" enctype="multipart/form-data"
            class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4 max-w-xl">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category_id" class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Makanan</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                <input type="file" name="photo"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Porsi</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Batas Waktu Ambil</label>
                    <input type="datetime-local" name="pickup_deadline" value="{{ old('pickup_deadline') }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
            </div>

            <button type="submit" class="bg-green-600 text-white font-medium px-6 py-2.5 rounded-xl hover:bg-green-700 transition">
                Upload Makanan
            </button>
        </form>
    </section>

</div>

@push('scripts')
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
    function qrScanner() {
        return {
            scanning: false,
            html5QrCode: null,

            startScan() {
                this.scanning = true;
                this.html5QrCode = new Html5Qrcode("qr-reader");
                this.html5QrCode.start(
                    { facingMode: "environment" },
                    { fps: 10, qrbox: 250 },
                    (decodedText) => {
                        this.stopScan();
                        this.$refs.qrInput.value = decodedText;
                        this.$refs.verifyForm.submit();
                    }
                );
            },

            stopScan() {
                if (this.html5QrCode) {
                    this.html5QrCode.stop().catch(() => {});
                }
                this.scanning = false;
            }
        }
    }
</script>
@endpush

@endsection