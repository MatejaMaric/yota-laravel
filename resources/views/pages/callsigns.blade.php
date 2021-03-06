@extends('layouts.app')

@section('title', 'Callsigns administration')

@section('navbar', View::make('inc.navbar'))

@section('content')
    <h3>Callsigns Administration:</h3>
    @if (session('statusE'))
      <div class="alert alert-success">
        {{ session('statusE') }}
      </div>
    @endif
    @if (count($data) > 0)
        <div class="p-0 mt-3 col-lg-6 table-responsive">
            <table class="table table-bordered">
                @foreach ($data as $row)
                    <tr>
                        <td class="align-middle">{{ $row->sign }}</td>
                        <td><a href="{{ route('editSign', $row->id) }}" class="btn btn-warning">Edit</a></td>
                        <td><a href="{{ route('deleteSign', $row->id) }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    @else
        <strong>There are currently no callsigns.</strong>
    @endif

    <h3 class="mt-4">Add Callsign:</h3>
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif
    <form action="{{ route('addSignForm') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="Sign">Special Callsign:</label>
            <input type="text" name="sign" value="" id="Sign" class="form-control" required>
            @error('sign')
              <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="editor">Description:</label>
            <textarea name="description" id="editor" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Add callsign" class="btn btn-primary">
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
