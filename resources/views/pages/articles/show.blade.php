@extends('layouts.app')

@section('title', $article->title . ' - FoodBridge')

@section('content')

<article class="max-w-2xl mx-auto">
    <a href="{{ route('articles.public.index') }}" class="text-gray-500 text-sm hover:text-green-600 inline-block mb-4">&larr; Semua Artikel</a>

    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $article->title }}</h1>
    <p class="text-gray-400 text-sm mb-6">oleh {{ $article->author->name }} &middot; {{ $article->published_at->format('d M Y') }}</p>

    @if ($article->cover_image)
        <img src="{{ Storage::url($article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-64 object-cover rounded-2xl mb-6">
    @endif

    <div class="prose text-gray-700 leading-relaxed whitespace-pre-line">
        {{ $article->content }}
    </div>
</article>

@endsection 