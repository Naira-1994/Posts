<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanEditArticle
{
    public function handle($request, Closure $next)
    {
        $article = $request->route('article');

        if ($article && $article->user_id === auth()->id()) {
            return $next($request);
        }

        return redirect()->route('article.index')->with('error', 'У вас нет доступа к этой статье');
    }
}
