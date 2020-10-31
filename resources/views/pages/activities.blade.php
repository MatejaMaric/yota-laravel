@extends('layouts.app')

@section('title', 'Special Calls - Activities')

@section('navbar', View::make('inc.special_navbar'))

@section('content')
@if (count($activities) > 0)
<div class="table-responsive">
    <table class="table table-striped table-bordered"><!-- table-hover -->
        <thead class="thead-dark">
            <tr><th>Operator</th><th>From</th><th>To</th><th>Special Callsign</th><th>Frequencies</th><th>QSO</th></tr>
        </thead>
        <tbody>
          @foreach ($activities as $row)
{{--'approved'--}}
{{--'specialCall'--}}
{{--'fromTime'--}}
{{--'toTime'--}}
{{--'frequencies'--}}
{{--'modes'--}}
{{--'operatorCall'--}}
{{--'operatorName'--}}
{{--'operatorEmail'--}}
{{--'operatorPhone'--}}
{{--'qso'--}}
            <tr>
              <td>{{ $row->operatorCall }}</td>
              <td>{{ $row->fromTime }}</td>
              <td>{{ $row->toTime }}</td>
              <td>{{ $row->specialCall }}</td>
              <td>{{ $row->frequencies }}</td>
              <td>{{ $row->qso }}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
</div>
@else
<div class="text-center">
  <strong>There are currently no approved activities.</strong>
</div>
@endif
@endsection()
