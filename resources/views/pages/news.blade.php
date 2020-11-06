@extends('layouts.app')

@section('title', 'News')

@section('content')
    @foreach($news as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">{{ $post->title }}</h2>
                <h6 class="card-subtitle mb-2 text-muted">Published at {{ $post->created_at->format('Y-m-d') }}@isset ($post->author) by {{$post->author }}@endisset</h4>
                <div class="card-text">{!! $post->text !!}</div>
            </div>
        </div>
    @endforeach
    {{ $news->links() }}
@endsection()
