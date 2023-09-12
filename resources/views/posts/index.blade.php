@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $post->created_at->format('d.m.Y H:i') }}
                </div>
                <div class="card-body">
                    <b><h5 class="card-title text-primary">{{ $post->title }}</h5></b>
                    <p class="card-text">
                        {{ Str::limit($post->content, 100) }}
                    </p>
                    <a href="{{ route('posts.show', $post->id) }}" target="_blank" class="btn btn-primary">Read more</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
