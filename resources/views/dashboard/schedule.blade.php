@extends('dashboard.layout.app')

@section('content')
<form action="{{ route('dashboard.appointment.store') }}" method="post">
    @csrf
    <label class="form-label" for="datepicker">Select the shift date</label>
    <input class="form-control datetimepicker" id="datepicker" name="shiftDate" type="text" placeholder="dd/mm/yy" value="{{ old('shiftDate') }}" data-options='{"disableMobile":true}' required />
    @error('shiftDate')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label class="form-label" for="timepicker1">Start Time</label>
    <input class="form-control datetimepicker" id="timepicker1" name="startTime" type="text" placeholder="Hour:Min" value="{{ old('startTime') }}" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' required />
    @error('startTime')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label class="form-label" for="timepicker2">End Time</label>
    <input class="form-control datetimepicker" id="timepicker2" name="endTime" type="text" placeholder="Hour:Min" value="{{ old('endTime') }}" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' required />
    @error('endTime')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button class="btn btn-primary" type="submit">Confirm</button>
</form>
@endsection