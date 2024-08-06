@extends('dashboard.layout.app')

@section('content')
<div class="table-responsive scrollbar">
    <table class="table mb-0">
        <thead class="bg-200">
            <tr>
                <th class="white-space-nowrap"></th>
                <th class="text-black dark__text-white align-middle">ID</th>
                <th class="text-black dark__text-white align-middle">Appointment Date</th>
                <th class="text-black dark__text-white align-middle">Appointment Time</th>
                <th class="text-black dark__text-white align-middle">Created At</th>
                <th class="text-black dark__text-white align-middle">Patient</th>
                <th class="text-black dark__text-white align-middle">Delete</th>
            </tr>
        </thead>
        <tbody id="bulk-select-body">
            @forelse ($appointments as $appointment)
            <tr>
                <td class="white-space-nowrap"></td>
                <td class="align-middle">{{ $appointment->id }}</td>
                <td class="align-middle">{{ $appointment->date }}</td>
                <td class="align-middle">{{ $appointment->time }}</td>
                <td class="align-middle">{{ $appointment->created_at->format('j M Y, g:i a') }}</td>
                <td class="align-middle">{{ $appointment->user_id }}</td>
                <td class="align-middle white-space-nowrap text-end pe-3">
                    <form method="POST" action="{{ route('dashboard.appointment.destroy', $appointment) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger me-1 mb-1" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">No appointments found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if ($appointments->hasPages())
{{ $appointments->links() }}
@endif
@endsection