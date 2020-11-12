@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
    <div class="row">
        @if (session('status'))
            <div class="col-12 alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="row">
        {{--<img class="col-lg-6 mb-3 mb-lg-0" src="/imgs/camp.png" alt="YOTA camp"/>--}}
        {{--<img class="col-lg-6 mb-3 mb-lg-0" src="/imgs/yota.jpg" alt="YOTA"/>--}}
        @if (count($images) > 0)
            @foreach ($images as $image)
                <div class="col-lg-6">
                    <div class="card mb-3">
                        <div class="card-img-top">
                            <img class="img-fluid" src="{{ asset('storage/' . $image->path . $image->name) }}" alt="{{ $image->name }}" loading="lazy">
                        </div>
                        @auth
                            <div class="card-body">
                                <a class="btn btn-danger" href="{{ route('galleryDelete', $image->id) }}">Delete</a>
                            </div>
                        @endauth
                    </div>
                </div>
            @endforeach
    </div>
            <div class="row">
            {{ $images->links() }}
            </div>
        @else
            <strong class="text-center">There are currently no images in gallery.</strong>
    </div>
        @endif
@endsection()
