@extends('layouts.app')

@section('title', 'Reservations')

@section('navbar', View::make('inc.special_navbar'))

@section('content')
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
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->approved }}</td>
                    <td>{{ $row->operatorCall }}</td>
                    <td>{{ $row->qso }}</td>
                    <td>{{ $row->fromTime }}</td>
                    <td>{{ $row->toTime }}</td>
                    <td>{{ $row->frequencies }}</td>
                    <td>{{ $row->modes }}</td>
                    <td>{{ $row->specialCall }}</td>
                    <td>{{ $row->operatorName }}</td>
                    <td>{{ $row->operatorEmail }}</td>
                    <td>{{ $row->operatorPhone }}</td>
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
@endsection()
