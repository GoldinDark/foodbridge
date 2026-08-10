@extends('layouts.app')

@section('title', 'Daftar - FoodBridge')

@section('content')
<div class="grid md:grid-cols-2 gap-8 items-center min-h-[70vh]">

    <div class="hidden md:block">
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-3xl p-10 text-white shadow-lg">
            <h2 class="text-3xl font-bold mb-4">Saving Food,<br>Sharing Hope 🌱</h2>
            <p class="text-green-50 leading-relaxed mb-6">
                Bergabunglah dengan ribuan orang yang membantu mengurangi makanan terbuang setiap hari.
            </p>
            <div class="space-y-3">
                <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3">
                    <span class="text-2xl">🍞</span>
                    <span class="text-sm">Klaim makanan berlebih dari restoran terdekat</span>
                </div>
                <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3">
                    <span class="text-2xl">🏆</span>
                    <span class="text-sm">Kumpulkan badge sebagai penyelamat makanan</span>
                </div>
                <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3">
                    <span class="text-2xl">🤝</span>
                    <span class="text-sm">Terhubung langsung dengan restoran & komunitas</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-md w-full mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Daftar Akun</h1>
        <p class="text-gray-500 text-sm mb-6">Bergabung dan mulai selamatkan makanan bersama kami.</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <button type="submit"
                class="w-full bg-green-600 text-white font-medium rounded-xl py-2.5 hover:bg-green-700 transition">
                Daftar
            </button>
        </form>

        <p class="text-sm text-gray-500 text-center mt-6">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-green-600 hover:underline">Login</a>
        </p>
    </div>

</div>
@endsection