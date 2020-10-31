@extends('layouts.app')

@section('title', 'News')

@section('content')
    @foreach($news as $post)
        <div class="well">
            <h3>{{ $post->title }}</h3>
            <small>Published at {{ $post->created_at->format('Y-m-d') }}@isset ($post->author) by {{$post->author }}@endisset</small>
            <p>{{ $post->text }}</p>
        </div>
    @endforeach
@endsection()
