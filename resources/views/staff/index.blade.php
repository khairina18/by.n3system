@extends('layouts.app')

@section('content')
<h2>Manage Staff</h2>

<a href="{{ route('staff.create') }}" class="btn btn-add"> Add Tutor</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($staff as $index => $tutor)
            <tr>
                <td>{{ $index + 1 }}</td> 
                <td>{{ $tutor->name }}</td>
                <td>{{ $tutor->email ?? '-' }}</td>
                <td>{{ $tutor->role }}</td>
                <td>
                    <a href="{{ route('staff.edit', $tutor->id) }}" class="btn btn-edit">Edit</a>
                    <form action="{{ route('staff.destroy', $tutor->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
