@extends('layouts.app')

@section('title', 'Tulis Artikel - FoodBridge')

@section('content')

<section class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Tulis Artikel Baru</h1>
</section>

<form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data"
    class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4 max-w-2xl">
    @csrf

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
        <input type="text" name="title" value="{{ old('title') }}"
            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Ringkasan Singkat</label>
        <textarea name="excerpt" rows="2"
            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('excerpt') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Cover Image</label>
        <input type="file" name="cover_image"
            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Isi Artikel</label>
        <textarea name="content" rows="10"
            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('content') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <select name="status" class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500">
            <option value="draft">Draft</option>
            <option value="published">Publikasikan</option>
        </select>
    </div>

    <button type="submit" class="bg-green-600 text-white font-medium px-6 py-2.5 rounded-xl hover:bg-green-700 transition">
        Simpan Artikel
    </button>
</form>

@endsection