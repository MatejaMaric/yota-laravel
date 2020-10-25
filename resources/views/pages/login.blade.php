@extends('layouts.app')

@section('content')
@if (session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
  </div>
@endif
<form action="{{ route('login') }}" method="POST">
  @csrf      
  <div class="form-group">
    <label for="email">Email: </label>
    <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}">
    @error('email')
      <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label for="pw">Password: </label>
    <input class="form-control @error('password') is-invalid @enderror" type="password" id="pw" name="password">
    @error('password')
      <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" value="Login">
  </div>
</form>
@endsection()
