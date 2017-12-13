@if ($message = Session::get('info'))
  <div class="alert -type-info">{{ $message }}</div>
@endif
@if ($message = Session::get('warning'))
  <div class="alert -type-warning">{{ $message }}</div>
@endif
@if ($message = Session::get('success'))
  <div class="alert -type-success">{{ $message }}</div>
@endif
@if ($message = Session::get('error'))
  <div class="alert -type-error">{{ $message }}</div>
@endif
