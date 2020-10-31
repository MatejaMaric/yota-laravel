@extends('layouts.app')

@section('title', 'Make reservation')

@section('navbar', View::make('inc.special_navbar'))

@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
<form action="{{ route('reserve') }}" method="POST">
  @csrf      
  <!-- SPECIAL CALL -->
<div class="form-group">
  <label for="special-call">Special Callsign:</label>
  <select class="form-control @error('scall') is-invalid @enderror" id="special-call" name="scall" required>
    <option value="YT50SCWC">YT50SCWC</option>
  </select> 
  @error('scall')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

  <!-- START TIME -->
<div class="form-group">
  <label for="start-date">Start date:</label>
  <input class="form-control @error('sdate') is-invalid @enderror" type="date" id="start-date" name="sdate" required>
  @error('sdate')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="start-time">Start time:</label>
  <input class="form-control @error('stime') is-invalid @enderror" type="time" id="start-time" name="stime" required>
  @error('stime')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

  <!-- END TIME -->
<div class="form-group">
  <label for="end-date">End date:</label>
  <input class="form-control @error('edate') is-invalid @enderror" type="date" id="end-date" name="edate" required>
  @error('edate')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="end-time">End time:</label>
  <input class="form-control @error('etime') is-invalid @enderror" type="time" id="end-time" name="etime" required>
  @error('etime')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

  <!-- BANDS -->
  <fieldset class="form-group">
    <legend>I will be active on bands:</legend>
<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb1" name="freqs[]" value="1.8 MHz">
    <label class="form-check-label" for="cb1">1.8 MHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb2" name="freqs[]" value="3.5 MHz">
    <label class="form-check-label" for="cb2">3.5 MHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb3" name="freqs[]" value="7 MHz">
    <label class="form-check-label" for="cb3">7 MHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb4" name="freqs[]" value="10 MHz">
    <label class="form-check-label" for="cb4">10 MHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb5" name="freqs[]" value="14 MHz">
    <label class="form-check-label" for="cb5">14 MHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb6" name="freqs[]" value="18 MHz">
    <label class="form-check-label" for="cb6">18 MHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb7" name="freqs[]" value="21 MHz">
    <label class="form-check-label" for="cb7">21 MHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb8" name="freqs[]" value="24 MHz">
    <label class="form-check-label" for="cb8">24 MHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb9" name="freqs[]" value="28 MHz">
    <label class="form-check-label" for="cb9">28 MHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb10" name="freqs[]" value="50 MHz">
    <label class="form-check-label" for="cb10">50 MHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb11" name="freqs[]" value="144 MHz">
    <label class="form-check-label" for="cb11">144 MHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb12" name="freqs[]" value="432 MHz">
    <label class="form-check-label" for="cb12">432 MHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb13" name="freqs[]" value="1.2 GHz">
    <label class="form-check-label" for="cb13">1.2 GHz</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="cb14" name="freqs[]" value="2.3 GHz">
    <label class="form-check-label" for="cb14">2.3 GHz</label>
</div>

@error('freqs')
  <div class="alert alert-danger mt-2">{{ $message }}</div>
@enderror
  </fieldset>
  <!-- MODES -->
  <fieldset class="form-group">
    <legend>I will use modes:</legend>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="CW" name="modes[]" value="CW">
    <label class="form-check-label" for="CW">CW</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="SSB" name="modes[]" value="SSB">
    <label class="form-check-label" for="SSB">SSB</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="FM" name="modes[]" value="FM">
    <label class="form-check-label" for="FM">FM</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="RTTY" name="modes[]" value="RTTY">
    <label class="form-check-label" for="RTTY">RTTY</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="MFSK" name="modes[]" value="MFSK">
    <label class="form-check-label" for="MFSK">MFSK (JT65, FT8...)</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="IMAGING" name="modes[]" value="IMAGING">
    <label class="form-check-label" for="IMAGING">IMAGING (ATV, SSTV...)</label>
</div>

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="OTHER DIGITAL" name="modes[]" value="OTHER DIGITAL">
    <label class="form-check-label" for="OTHER DIGITAL">OTHER DIGITAL</label>
</div>

@error('modes')
  <div class="alert alert-danger mt-2">{{ $message }}</div>
@enderror
  </fieldset>

  <!-- OPERATOR CALL -->
<div class="form-group">
  <label for="operator-call">Operator Callsign:</label>
  <input class="form-control @error('ocall') is-invalid @enderror" type="text" id="operator-call" name="ocall" required>
  @error('ocall')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

  <!-- OPERATOR NAME -->
<div class="form-group">
  <label for="operator-name">Operator name:</label>
  <input class="form-control @error('oname') is-invalid @enderror" type="text" id="operator-name" name="oname" required>
  @error('oname')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

  <!-- OPERATOR EMAIL -->
<div class="form-group">
  <label for="operator-email">Operator email:</label>
  <input class="form-control @error('email') is-invalid @enderror" type="email" id="operator-email" name="email" required>
  @error('email')
    <div class="alert alert-danger mt-2">{{ $message }}</div>
  @enderror
</div>

  <!-- OPERATOR PHONE -->
<div class="form-group">
  <label for="operator-phone">Operator phone:</label>
  <input class="form-control @error('phone') is-invalid @enderror" type="tel" id="operator-phone" name="phone" required>
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
