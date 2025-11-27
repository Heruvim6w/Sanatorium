<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory
    {
        $categories = Category::with('articles')->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View|Application|Factory
    {
        $category->load(['articles' => fn($q) => $q->orderBy('published_at', 'desc')]);

        return view('categories.show', compact('category'));
    }
}
