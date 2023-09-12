<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function show($id): View
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $article = new Post;

        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->user_id = Auth::user()->id;

        $article->save();

        return redirect('/posts');
    }

    public function edit(Post $article)
    {
        if ($article->user_id !== auth()->id()) {
            return redirect()->route('article.index')->with('error', 'У вас нет доступа к редактированию этой статьи');
        }

        return view('posts.edit', compact('article'));
    }

    public function update(Request $request, Post $article)
    {
        if ($article->user_id !== auth()->id()) {
            return redirect()->route('article.index')->with('error', 'У вас нет доступа к редактированию этой статьи');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $article->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('article.show', $article)->with('success', 'Статья успешно обновлена');
    }

    public function destroy(Post $article): RedirectResponse
    {
        if ($article->user_id !== auth()->id()) {
            return redirect()->route('article.index')->with('error', 'У вас нет доступа к удалению этой статьи');
        }

        $article->delete();

        return redirect()->route('article.index')->with('success', 'Статья успешно удалена');
    }

}
