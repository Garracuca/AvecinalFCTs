@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Shift</h1>
    <form action="{{ route('shifts.update', $shift) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $shift->name }}" required>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" name="start_time" class="form-control" value="{{ $shift->start_time }}" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="time" name="end_time" class="form-control" value="{{ $shift->end_time }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
