@extends('dashboard.layout.app')
@section('content')
<div class="table-responsive scrollbar">
    <table class="table mb-0">
        <thead class="bg-200">
            <tr>
                <th class="text-black dark__text-white align-middle">Rating</th>
                <th class="text-black dark__text-white align-middle">User ID</th>
                <th class="text-black dark__text-white align-middle">Patient Name</th>
                <th class="text-black dark__text-white align-middle">Appointment Date/Time</th>
                <th class="text-black dark__text-white align-middle">Created At</th>
            </tr>
        </thead>
        <tbody id="bulk-select-body">
            @forelse ($ratings as $rating)
            <tr>
                <td class="align-middle">{{$rating->rating }}</td>
                <td class="align-middle">{{$rating->appointment->user->id }}</td>
                <td class="align-middle">{{$rating->appointment->user->name }}</td>
                <td class="align-middle">{{$rating->appointment->date }} {{$rating->appointment->time }}</td>
                <td class="align-middle">{{$rating->created_at}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8">No ratings found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if ($ratings->hasPages())
{{ $ratings->links() }}
@endif
@endsection