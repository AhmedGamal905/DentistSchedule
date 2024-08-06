@extends('dashboard.layout.app')

@section('content')
<form action="{{ route('dashboard.appointment.store') }}" method="post">
    @csrf
    <label class="form-label" for="datepicker">Select the shift date</label>
    <input class="form-control datetimepicker" id="datepicker" name="shift_date" type="text" placeholder="dd/mm/yy" value="{{ old('shift_date') }}" data-options='{"disableMobile":true}' required />
    @error('shift_date')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label class="form-label" for="timepicker1">Start Time</label>
    <input class="form-control datetimepicker" id="timepicker1" name="start_time" type="text" placeholder="Hour:Min" value="{{ old('start_time') }}" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' required />
    @error('start_time')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label class="form-label" for="timepicker2">End Time</label>
    <input class="form-control datetimepicker" id="timepicker2" name="end_time" type="text" placeholder="Hour:Min" value="{{ old('end_time') }}" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' required />
    @error('end_time')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button class="btn btn-primary" type="submit">Confirm</button>
</form>
@endsection