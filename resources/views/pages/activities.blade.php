@extends('layouts.app')

@section('title', 'Special Calls - Activities')

@section('navbar', View::make('inc.navbar'))

@section('content')
<input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
<label for="call-sign">Filter by special callsign: </label>
<select id="call-sign">
    <option value="all">All</option>
    @if (count($signs) > 0)
        @foreach ($signs as $sign)
            <option value="{{ $sign->sign }}">{{ $sign->sign }}</option>
        @endforeach
    @endif
</select>

<div id="sign-desc-div"></div>

<div class="table-responsive mt-2">
    <table id="ajax-table" class="table table-striped table-bordered" style="white-space:nowrap;">
        <thead class="thead-dark">
            <tr><th>Operator</th><th>From</th><th>To</th><th>Special Callsign</th><th>Frequencies</th><th>QSO</th></tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection()

@section('scripts')
    <script src="{{ asset('js/activities.js') }}"></script>
@endsection
