@extends('layouts.app')

@section('content')
    <h1>Manage Classes</h1>
    <a href="{{ route('classes.create') }}" class="btn btn-add">Add New Class</a>

    <table>
        <thead>
            <tr>
                <th>Class Code</th>
                <th>Type of Class</th>
                <th>Age</th>
                <th>Subject</th>
                <th>Fee (RM)</th>
                <th>Actions</th>
            </tr>        
        </thead>
        <tbody>
            @forelse ($classes as $class)
                <tr>
                    <td>{{ $class->code }}</td>
                    <td>{{ $class->type_of_class }}</td>
                    <td>{{ $class->age }}</td>
                    <td>{{ $class->subject }}</td>
                    <td>{{ number_format($class->fee_per_hour, 2) }}</td>
                    <td>
                        <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No classes found</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
