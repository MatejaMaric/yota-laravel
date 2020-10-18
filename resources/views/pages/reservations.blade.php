@extends('layouts.app')

@section('content')
<div class="table-responsive">
    <table class="table table-striped table-bordered"><!-- table-hover -->
        <thead class="thead-dark">
            <tr><th>ID</th><th>Approved</th><th>Operator Callsign</th><th>QSO</th><th>From</th><th>To</th><th>Frequencies</th><th>Modes</th><th>Special Callsign</th><th>Operator Name</th><th>Operator Email</th><th>Operator Phone</th><th>Actions</th></tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection()
