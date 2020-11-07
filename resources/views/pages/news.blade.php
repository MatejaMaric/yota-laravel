@extends('layouts.app')

@section('title', 'News')

@section('content')
    @if (session('statusE'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif
    @if (count($news) > 0)
        @foreach($news as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <h6 class="card-subtitle mb-2 text-muted">Published at {{ $post->created_at->format('Y-m-d') }}@isset ($post->author) by {{$post->author }}@endisset</h4>
                    <div class="card-text">{!! $post->text !!}</div>
                </div>
                <div class="mt-3 card-footer">
                    <a href="{{ route('newsEdit', $post->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('newsDelete', $post->id) }}" class="float-right btn btn-danger">Delete</a>
                </div>
            </div>
        @endforeach
        {{ $news->links() }}
    @else
        <strong class="text-center">There are no news.</strong>
    @endif
@endsection()
