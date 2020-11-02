@extends('layouts.app')

@section('title', 'News')

@section('content')
    @foreach($news as $post)
        <div class="well border border-secondary rounded p-2 mb-3">
            <h2>{{ $post->title }}</h2>
            <small>Published at {{ $post->created_at->format('Y-m-d') }}@isset ($post->author) by {{$post->author }}@endisset</small>
            <hr class="bg-secondary">
            <div>{!! $post->text !!}</div>
        </div>
    @endforeach
@endsection()
