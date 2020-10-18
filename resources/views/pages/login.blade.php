@extends('layouts.app')

@section('content')
<form action="{{ route('login') }}" method="POST">
  @csrf      
  <div class="form-group">
    <label for="email">Email: </label>
    <input class="form-control" type="email" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="pw">Password: </label>
    <input class="form-control" type="password" id="pw" name="password">
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" value="Login">
  </div>
</form>
@endsection()
