<!DOCTYPE html>
<html>
<head>
    <title>{{ $food->name }} - FoodBridge</title>
</head>
<body>
    @if ($errors->any())
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('foods.index') }}">Kembali ke Daftar Makanan</a>

    <h1>{{ $food->name }}</h1>

    @if ($food->photo)
        <img src="{{ Storage::url($food->photo) }}" alt="{{ $food->name }}" style="max-width: 400px;">
    @endif

    <p>{{ $food->description }}</p>

    <hr>

    <p><strong>Restoran:</strong> {{ $food->restaurant->business_name }}</p>
    @if ($avgRating > 0)
    <p class="flex items-center gap-1">
        <strong>Rating:</strong>
        <span class="text-orange-400">★</span> {{ $avgRating }} / 5
    </p>
@endif
    <p><strong>Alamat:</strong> {{ $food->restaurant->address }}</p>
    <p><strong>Kategori:</strong> {{ $food->category->name }}</p>
    <p><strong>Sisa Porsi:</strong> {{ $food->quantity }}</p>
    <p><strong>Batas Waktu Ambil:</strong> {{ $food->pickup_deadline->format('d M Y, H:i') }}</p>
    <p><strong>Status:</strong> {{ $food->status }}</p>

    @auth
    @php
        $isFavorited = auth()->user()->favoriteFoods()->where('food_id', $food->id)->exists();
    @endphp
    <form method="POST" action="{{ route('favorites.toggle', $food) }}" class="inline-block mb-3">
        @csrf
        <button type="submit" class="flex items-center gap-2 text-sm {{ $isFavorited ? 'text-red-500' : 'text-gray-400' }} hover:text-red-500 transition">
            <svg class="w-5 h-5" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            {{ $isFavorited ? 'Difavoritkan' : 'Favoritkan' }}
        </button>
    </form>
@endauth

    @auth
        <form method="POST" action="{{ route('claims.store', $food) }}">
        @csrf
        <button type="submit">Klaim Sekarang</button>
    </form>
    @else
        <p><a href="{{ route('login') }}">Login</a> untuk bisa mengklaim makanan ini.</p>
    @endauth
</body>
</html>