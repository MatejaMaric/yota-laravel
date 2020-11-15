@extends('layouts.app')

@section('title', 'Reservations')

@section('navbar', View::make('inc.navbar'))

@section('content')
@if (count($data) > 0)
<div class="table-responsive">
    <table class="table table-striped table-bordered" style="white-space:nowrap;"><!-- table-hover -->
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Approved</th>
                <th>Operator Callsign</th>
                <th>QSO</th>
                <th>From</th>
                <th>To</th>
                <th>Frequencies</th>
                <th>Modes</th>
                <th>Special Callsign</th>
                <th>Operator Name</th>
                <th>Operator Email</th>
                <th>Operator Phone</th>
                <th>Actions</th>
            </tr>
            @foreach ($data as $row)
                <tr>
                    <td class="align-middle">{{ $row->id }}</td>
                    @if ($row->approved)
                       <td class="align-middle"><input type="checkbox" checked></td> 
                    @else
                       <td class="align-middle"><input type="checkbox"></td> 
                    @endif
                    <td class="align-middle">{{ $row->operatorCall }}</td>
                    <td class="align-middle">{{ $row->qso }}</td>
                    <td class="align-middle">{{ $row->fromTime }}</td>
                    <td class="align-middle">{{ $row->toTime }}</td>
                    <td class="align-middle">{{ $row->frequencies }}</td>
                    <td class="align-middle">{{ $row->modes }}</td>
                    <td class="align-middle">{{ $row->specialCall }}</td>
                    <td class="align-middle">{{ $row->operatorName }}</td>
                    <td class="align-middle">{{ $row->operatorEmail }}</td>
                    <td class="align-middle">{{ $row->operatorPhone }}</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-warning">Restore</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@else
<div class="text-center">
    <strong>There are currently no reservations.</strong>
</div>
@endif
@endsection()
