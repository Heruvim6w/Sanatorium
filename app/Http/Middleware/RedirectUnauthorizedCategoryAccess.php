<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectUnauthorizedCategoryAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $category = $request->route('category');

        if ($category && ($category->slug === 'general_meetings' || $category->slug === 'for_gardeners')) {
            if (!auth()->check()) {
                return redirect()->route('login');
            }
        }

        $article = $request->route('article');
        if (
            $article
            && ($article->category->slug === 'general_meetings' || $article->category->slug === 'for_gardeners')
        ) {
            if (!auth()->check()) {
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
