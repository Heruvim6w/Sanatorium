<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AboutController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(): View|Application|Factory
    {
        $about = About::query()->first();

        return view('about', compact('about'));
    }
}
