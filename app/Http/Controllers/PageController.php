<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function restaurants()
    {
        $restaurants = Restaurant::where('verification_status', 'verified')
            ->withCount('foods')
            ->latest()
            ->paginate(9);

        return view('pages.restaurants', [
            'restaurants' => $restaurants,
        ]);
    }

    public function articles()
    {
        $articles = \App\Models\Article::where('status', 'published')
            ->with('author')
            ->latest('published_at')
            ->paginate(9);

        return view('pages.articles.index', [
            'articles' => $articles,
        ]);
    }

    public function articleShow(\App\Models\Article $article)
    {
        if ($article->status !== 'published') {
            abort(404);
        }

        return view('pages.articles.show', [
            'article' => $article,
        ]);
    }
}