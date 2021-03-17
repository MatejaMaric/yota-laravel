@extends('layouts.app')

@section('title', 'Reservations')

@section('navbar', View::make('inc.navbar'))

@section('content')
    <reservations-view></reservations-view>
@endsection()
