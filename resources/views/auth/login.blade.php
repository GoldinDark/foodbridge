@extends('layouts.app')

@section('title', 'Login - FoodBridge')

@section('content')
<div class="grid md:grid-cols-2 gap-8 items-center min-h-[70vh]">

    <div class="hidden md:block">
        <div class="bg-gradient-to-br from-orange-400 to-orange-500 rounded-3xl p-10 text-white shadow-lg">
            <h2 class="text-3xl font-bold mb-4">Selamat Datang<br>Kembali! </h2>
            <p class="text-orange-50 leading-relaxed mb-6">
                Ribuan porsi makanan sudah terselamatkan berkat kontribusi Anda dan komunitas FoodBridge.
            </p>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-white/10 rounded-xl px-4 py-4 text-center">
                    <div class="text-2xl font-bold">1.234+</div>
                    <div class="text-xs text-orange-50">Porsi Terselamatkan</div>
                </div>
                <div class="bg-white/10 rounded-xl px-4 py-4 text-center">
                    <div class="text-2xl font-bold">50+</div>
                    <div class="text-xs text-orange-50">Restoran Mitra</div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-md w-full mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Masuk ke Akun</h1>
        <p class="text-gray-500 text-sm mb-6">Selamat datang kembali di FoodBridge.</p>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <button type="submit"
                class="w-full bg-green-600 text-white font-medium rounded-xl py-2.5 hover:bg-green-700 transition">
                Login
            </button>
        </form>

        <p class="text-sm text-gray-500 text-center mt-6">
            Belum punya akun? <a href="{{ route('register') }}" class="text-green-600 hover:underline">Daftar</a>
        </p>
    </div>

</div>
@endsection