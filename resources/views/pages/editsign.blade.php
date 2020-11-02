@extends('layouts.app')

@section('title', 'Edit callsign')

@section('navbar', View::make('inc.special_navbar'))

@section('content')
    <h3 class="mt-2">Edit Callsign:</h3>
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif
    <form action="{{ route('editSignForm', request()->route()->parameter('id')) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="Sign">Special Callsign:</label>
            <input type="text" name="sign" value="{{ ols('sign') ?? $data->sign }}" id="Sign" class="form-control">
            @error('sign')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="editor">Description:</label>
            <textarea name="description" id="editor" class="form-control">{{ old('description') ?? $data->description }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Edit callsign" class="btn btn-primary">
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
