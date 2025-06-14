@extends('layouts.app')

@section('content')
    <h1>Manage Students</h1>
    <a href="{{ route('students.create') }}" class="btn btn-add">Add New Student</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->age }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-edit">Edit</a>
                        
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Delete this student?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #999;">No students available yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
