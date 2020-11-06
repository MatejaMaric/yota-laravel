@extends('layouts.app')

@section('title', 'Add image')

@section('content')
    <form action="{{ route('galleryAddForm')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="file" placeholder="Choose images" name="images"/>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary"/>
    </form>
@endsection()
