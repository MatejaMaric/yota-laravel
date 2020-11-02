@extends('layouts.app')

@section('title', 'Edit post')

@section('navbar', View::make('inc.navbar'))

@section('content')
    <h3 class="mt-2">Edit Post:</h3>
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif
    <form action="{{ route('newsEditForm', request()->route()->parameter('id')) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ old('title') ?? $data->title }}" id="title" class="form-control" required>
            @error('title')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" name="author" value="{{ old('author') ?? $data->author }}" id="author" class="form-control">
        </div>

        <div class="form-group">
            <label for="editor">Text:</label>
            <textarea name="text" id="editor" class="form-control">{{ old('text') ?? $data->text }}</textarea>
            @error('text')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input type="submit" name="submit" value="Edit post" class="btn btn-primary">
            <input type="submit" name="submit" value="Cancel" class="btn btn-secondary">
        </div>
    </form>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#editor'))
    .catch(error => {
        console.error( error );
    });
</script>
@endsection
