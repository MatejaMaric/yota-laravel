@extends('layouts.app')

@section('title', 'Callsigns administration')

@section('navbar', View::make('inc.special_navbar'))

@section('content')
    <h3>Callsigns Administration:</h3>
    @if (count($data) > 0)
        <div class="p-0 mr-0 mt-3 col-lg-6 table-responsive">
            <table class="table table-bordered">
                @foreach ($data as $row)
                    <tr>
                        <td class="align-middle">{{ $row->sign }}</td>
                        <td><button class="btn btn-warning">Edit</button></td>
                        <td><button class="btn btn-danger">Delete</button></td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif

    <h3 class="mt-4">Add Callsign:</h3>
    <form action="{{ route('addSignForm') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="Sign">Special Callsign:</label>
            <input type="text" name="sign" value="" id="Sign" class="form-control">
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
ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
</script>
@endsection
