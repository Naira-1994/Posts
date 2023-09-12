<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function store(Request $request, $postId): RedirectResponse
    {
        $post = Post::find($postId);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $post->id;
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Комментарий успешно добавлен');
    }

    public function show($postId): View
    {
        $post = Post::find($postId);
        $comments = $post->comments()->orderBy('created_at', 'asc')->get();

        return view('posts.show', compact('post', 'comments'));
    }
}
