@extends('layouts.app')

@section('title', 'Make reservation')

@section('navbar', View::make('inc.navbar'))

@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger">
      All fields must be filled and conditions satisfied!
    </div>
  @endif
<form action="{{ route('reserve') }}" method="POST">
  @csrf      

  <!-- SPECIAL CALL -->
  <call-sign-description name="scall" old="{{ old('scall') }}" @error('scall') is-invalid="true" @enderror >
  </call-sign-description>
  @error('scall')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror


@error('time')
  <div class="alert alert-danger mt-2">{{ $message }}</div>
@enderror
  <!-- START TIME -->
<div class="form-group">
  <label for="start-date">Start date:</label>
  <input class="jquery-date form-control @error('sdate') is-invalid @enderror" type="text" placeholder="DD.MM.YYYY." id="start-date" name="sdate" value="{{ old('sdate') }}" required>
  @error('sdate')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="start-time">Start time:</label>
  <input class="jquery-time form-control @error('stime') is-invalid @enderror" type="text" placeholder="HH:MM" id="start-time" name="stime" value="{{ old('stime') }}" required>
  @error('stime')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

  <!-- END TIME -->
<div class="form-group">
  <label for="end-date">End date:</label>
  <input class="jquery-date form-control @error('edate') is-invalid @enderror" type="text" placeholder="DD.MM.YYYY." id="end-date" name="edate" value="{{ old('edate') }}" required>
  @error('edate')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="end-time">End time:</label>
  <input class="jquery-time form-control @error('etime') is-invalid @enderror" type="text" placeholder="HH:MM" id="end-time" name="etime" value="{{ old('etime') }}" required>
  @error('etime')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

<!-- BANDS -->
<fieldset class="form-group">
  <legend>I will be active on bands:</legend>
@foreach ($freq_list as $freq)
  <div class="form-check">
      <input class="form-check-input" type="checkbox" id="fcb{{ $loop->index }}" name="freqs[]" value="{{ $freq }}" @if(is_array(old('freqs')) && in_array($freq, old('freqs'))) checked @endif>
      <label class="form-check-label" for="fcb{{ $loop->index }}">{{ $freq }}</label>
  </div>
@endforeach

@error('freqs')
  <div class="alert alert-danger mt-2">{{ $message }}</div>
@enderror
</fieldset>

<!-- MODES -->
<fieldset class="form-group">
  <legend>I will use modes:</legend>

@foreach ($mode_list as $key => $value)
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="mcb{{ $loop->index }}" name="modes[]" value="{{ $key }}" @if(is_array(old('modes')) && in_array($key, old('modes'))) checked @endif>
    <label class="form-check-label" for="mcb{{ $loop->index }}">{{ $value }}</label>
  </div>
@endforeach

@error('modes')
  <div class="alert alert-danger mt-2">{{ $message }}</div>
@enderror
</fieldset>

  <!-- OPERATOR CALL -->
<div class="form-group">
  <label for="operator-call">Operator Callsign:</label>
  <input class="form-control @error('ocall') is-invalid @enderror" type="text" id="operator-call" name="ocall" value="{{ old('ocall') }}" required>
  @error('ocall')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

  <!-- OPERATOR NAME -->
<div class="form-group">
  <label for="operator-name">Operator name:</label>
  <input class="form-control @error('oname') is-invalid @enderror" type="text" id="operator-name" name="oname" value="{{ old('oname') }}" required>
  @error('oname')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

  <!-- OPERATOR EMAIL -->
<div class="form-group">
  <label for="operator-email">Operator email:</label>
  <input class="form-control @error('email') is-invalid @enderror" type="email" id="operator-email" name="email" value="{{ old('email') }}" required>
  @error('email')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

  <!-- OPERATOR PHONE -->
<div class="form-group">
  <label for="operator-phone">Operator phone:</label>
  <input class="form-control @error('phone') is-invalid @enderror" type="tel" id="operator-phone" name="phone" value="{{ old('phone') }}" required>
  @error('phone')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

  <!-- SUBMIT BUTTON -->
<div class="form-group">
  <input class="btn btn-primary" type="submit" value="Submit reservation request">
</div>
</form>
@endsection()

@section('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" />
@endsection

@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>
  <script>
    jQuery('.jquery-date').datetimepicker({
      timepicker: false,
      format: 'd.m.Y.'
    });
    jQuery('.jquery-time').datetimepicker({
      datepicker: false,
      format: 'H:i'
    });
  </script>
@endsection
