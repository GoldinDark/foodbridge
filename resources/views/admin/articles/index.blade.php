@extends('layouts.app')

@section('title', 'Kelola Artikel - FoodBridge')

@section('content')

<section class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Kelola Artikel</h1>
    <a href="{{ route('admin.articles.create') }}" class="bg-green-600 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-green-700 transition">
        + Tulis Artikel
    </a>
</section>

@forelse ($articles as $article)
    <div class="bg-white rounded-2xl border border-gray-100 p-5 mb-4 flex items-center justify-between gap-4">
        <div>
            <h3 class="font-semibold text-gray-900">{{ $article->title }}</h3>
            <p class="text-gray-400 text-xs">oleh {{ $article->author->name }} &middot; {{ $article->created_at->diffForHumans() }}</p>
        </div>
        <span class="text-xs font-medium px-3 py-1 rounded-full whitespace-nowrap {{ $article->status === 'published' ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
            {{ ucfirst($article->status) }}
        </span>
    </div>
@empty
    <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center text-gray-400">
        Belum ada artikel.
    </div>
@endforelse

<div>{{ $articles->links() }}</div>

@endsection