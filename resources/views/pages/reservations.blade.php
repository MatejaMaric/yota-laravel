@extends('layouts.app')

@section('title', 'Reservations')

@section('navbar', View::make('inc.navbar'))

@section('scripts')
    <script src="{{ asset('js/reservations.js') }}"></script>
@endsection

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
<div id="notice" class="float-right font-weight-bold"></div>        

<div class="table-responsive mt-2">
    <table id="ajax-table" class="table table-striped table-bordered" style="white-space:nowrap;"><!-- table-hover -->
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Approved</th>
                <th>Operator Callsign</th>
                <th>QSO</th>
                <th>From</th>
                <th>To</th>
                <th>Special Callsign</th>
                <th>Frequencies</th>
                <th>Modes</th>
                <th>Operator Name</th>
                <th>Operator Email</th>
                <th>Operator Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
{{--@if (count($data) > 0)--}}
{{--<div class="table-responsive">--}}
    {{--<table class="table table-striped table-bordered" style="white-space:nowrap;"><!-- table-hover -->--}}
        {{--<thead class="thead-dark">--}}
            {{--<tr>--}}
                {{--<th>ID</th>--}}
                {{--<th>Approved</th>--}}
                {{--<th>Operator Callsign</th>--}}
                {{--<th>QSO</th>--}}
                {{--<th>From</th>--}}
                {{--<th>To</th>--}}
                {{--<th>Frequencies</th>--}}
                {{--<th>Modes</th>--}}
                {{--<th>Special Callsign</th>--}}
                {{--<th>Operator Name</th>--}}
                {{--<th>Operator Email</th>--}}
                {{--<th>Operator Phone</th>--}}
                {{--<th>Actions</th>--}}
            {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
            {{--@foreach ($data as $row)--}}
                {{--<tr>--}}
                    {{--<td class="align-middle">{{ $row->id }}</td>--}}
                    {{--@if ($row->approved)--}}
                       {{--<td class="align-middle"><input type="checkbox" checked></td> --}}
                    {{--@else--}}
                       {{--<td class="align-middle"><input type="checkbox"></td> --}}
                    {{--@endif--}}
                    {{--<td class="align-middle">{{ $row->operatorCall }}</td>--}}
                    {{--<td class="align-middle">{{ $row->qso }}</td>--}}
                    {{--<td class="align-middle">{{ $row->fromTime }}</td>--}}
                    {{--<td class="align-middle">{{ $row->toTime }}</td>--}}
                    {{--<td class="align-middle">{{ $row->frequencies }}</td>--}}
                    {{--<td class="align-middle">{{ $row->modes }}</td>--}}
                    {{--<td class="align-middle">{{ $row->specialCall }}</td>--}}
                    {{--<td class="align-middle">{{ $row->operatorName }}</td>--}}
                    {{--<td class="align-middle">{{ $row->operatorEmail }}</td>--}}
                    {{--<td class="align-middle">{{ $row->operatorPhone }}</td>--}}
                    {{--<td>--}}
                        {{--<button class="btn btn-primary">Update</button>--}}
                        {{--<button class="btn btn-warning">Restore</button>--}}
                        {{--<button class="btn btn-danger">Delete</button>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            {{--@endforeach--}}
        {{--</tbody>--}}
    {{--</table>--}}
{{--</div>--}}
{{--@else--}}
{{--<div class="text-center">--}}
    {{--<strong>There are currently no reservations.</strong>--}}
{{--</div>--}}
{{--@endif--}}
@endsection()
