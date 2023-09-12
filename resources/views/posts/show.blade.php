@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                {{ $post->created_at->format('d.m.Y H:i') }}
            </div>
            <div class="card-body">
                <h5 class="card-title text-primary">{{ $post->title }}</h5>
                <p class="card-text">
                    {{ $post->content }}
                </p>
            </div>
        </div>

        @if (auth()->check())
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Добавить комментарий</h3>
                    <form action="{{ route('comments.store', $post->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" class="form-control" placeholder="Добавьте комментарий" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить комментарий</button>
                    </form>
                </div>
            </div>
        @endif

        <h3 class="mb-4">Комментарии:</h3>
        @if ($post->comments->count() > 0)
            <ul class="list-group">
                @foreach ($post->comments as $comment)
                    <li class="list-group-item">
                        <strong>{{ $comment->user->name }}</strong>
                        <small>{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                        <p>{{ $comment->content }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Пока нет комментариев.</p>
        @endif
    </div>
@endsection
