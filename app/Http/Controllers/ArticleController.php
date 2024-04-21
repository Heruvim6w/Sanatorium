<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory
    {
        $articles = Article::all();

        return view('articles.index', compact('articles'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): View|Application|Factory
    {
        return view('articles.show', compact('article'));
    }
}
