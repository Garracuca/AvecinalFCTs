@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shifts</h1>
    <a href="{{ route('shifts.create') }}" class="btn btn-primary mb-3">Create Shift</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Type</th>
                <th>User</th>
                <th>Week</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shifts as $shift)
                <tr>
                    <td>{{ $shift->typeShift->name }}</td>
                    <td>{{ optional($shift->user)->name }}</td>
                    <td>{{ $shift->week->name }}</td>
                    <td>{{ $shift->date }} {{ $shift->hour }}</td>
                    <td>{{ \Carbon\Carbon::parse($shift->hour)->addHours($shift->duration)->format('H:i') }}</td>
                    <td>
                        <a href="{{ route('shifts.edit', $shift) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('shifts.destroy', $shift) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
