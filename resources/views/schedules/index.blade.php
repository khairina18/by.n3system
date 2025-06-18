@extends('layouts.app')

@section('content')
    <h1>Manage Schedules</h1>
    <a href="{{ route('schedules.create') }}" class="btn btn-add">Add New Schedule</a>

    <table>
        <thead>
            <tr>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Class Code</th>
                <th>Tutor</th>
                <th>Actions</th>
            </tr>        
        </thead>
        <tbody>
            @forelse ($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->day }}</td>
                    <td>{{ \Carbon\Carbon::parse($schedule->time)->format('h:i A') }}</td>
                    <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</td>
                    <td>{{ $schedule->class->code ?? '—' }}</td>
                    <td>{{ $schedule->staff->name ?? '—' }}</td>
                    <td>
                        <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No schedules found</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
