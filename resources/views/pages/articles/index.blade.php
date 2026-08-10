@extends('layouts.app')

@section('title', 'Artikel - FoodBridge')

@section('content')

<section class="text-center mb-10">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Artikel & Wawasan</h1>
    <p class="text-gray-500">Baca cerita dan tips seputar penyelamatan makanan.</p>
</section>

@if ($articles->count() > 0)
    <div class="grid gap-6" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
        @foreach ($articles as $article)
            <a href="{{ route('articles.public.show', $article) }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                @if ($article->cover_image)
                    <img src="{{ Storage::url($article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-40 object-cover">
                @else
                    <div class="w-full h-40 bg-gradient-to-br from-green-100 to-orange-100"></div>
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-1">{{ $article->title }}</h3>
                    <p class="text-gray-500 text-sm line-clamp-2">{{ $article->excerpt }}</p>
                </div>
            </a>
        @endforeach
    </div>
    <div class="mt-6">{{ $articles->links() }}</div>
@else
    <p class="text-center text-gray-400">Belum ada artikel.</p>
@endif

@endsection