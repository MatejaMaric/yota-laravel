@extends('layouts.app')

@section('title', 'Special Calls - Activities')

@section('navbar', View::make('inc.special_navbar'))

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

<div class="table-responsive mt-2">
    <table id="ajax-table" class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr><th>Operator</th><th>From</th><th>To</th><th>Special Callsign</th><th>Frequencies</th><th>QSO</th></tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{--@if (count($activities) > 0)--}}
{{--<div class="table-responsive">--}}
    {{--<table class="table table-striped table-bordered"><!-- table-hover -->--}}
        {{--<thead class="thead-dark">--}}
            {{--<tr><th>Operator</th><th>From</th><th>To</th><th>Special Callsign</th><th>Frequencies</th><th>QSO</th></tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
          {{--@foreach ($activities as $row)--}}
            {{--<tr>--}}
              {{--<td>{{ $row->operatorCall }}</td>--}}
              {{--<td>{{ $row->fromTime }}</td>--}}
              {{--<td>{{ $row->toTime }}</td>--}}
              {{--<td>{{ $row->specialCall }}</td>--}}
              {{--<td>{{ $row->frequencies }}</td>--}}
              {{--<td>{{ $row->qso }}</td>--}}
            {{--</tr>--}}
          {{--@endforeach--}}
        {{--</tbody>--}}
    {{--</table>--}}
{{--</div>--}}
{{--@else--}}
{{--<div class="text-center">--}}
  {{--<strong>There are currently no approved activities.</strong>--}}
{{--</div>--}}
{{--@endif--}}
@endsection()

@section('scripts')
    <script src="{{ asset('js/activities.js') }}"></script>
@endsection
