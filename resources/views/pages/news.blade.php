@extends('layouts.app')

@section('content')
    @foreach($news as $post)
        <div class="well">
            <h3>{{ $post->title }}</h3>
            <small>Written at: {{ $post->created_at }}</small>
            <p>{{ $post->text }}</p>
            @isset ($post->author)
                <small>Author: {{ $post->author }}</small>
            @endisset
        </div>
    @endforeach
@endsection()
