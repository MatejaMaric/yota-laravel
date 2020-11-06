@extends('layouts.app')

@section('title', 'Add image')

@section('content')
    <form action="{{ route('galleryAddForm')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <label for="img">Choose images:</label>
            <br>
            <input type="file" name="images[]" id="img" accept="image/*" multiple required>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary"/>
    </form>
@endsection()
