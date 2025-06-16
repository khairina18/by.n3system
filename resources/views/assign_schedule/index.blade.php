@extends('layouts.app')

@section('content')
<h2>Assigned Schedules</h2>
<a href="{{ route('assign_schedule.create') }}" class="btn btn-add">Assign New</a>

<table>
    <thead>
        <tr>
            <th>Student</th>
            <th>Class Code</th>
            <th>Subject</th>
            <th>Age</th>
            <th>Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach($assignments as $assign)
        @php
            $details = config('classcodes')[$assign->class_code];
        @endphp
        <tr>
            <td>{{ $assign->student->name }}</td>
            <td>{{ $assign->class_code }}</td>
            <td>{{ $details['subject'] }}</td>
            <td>{{ $details['age'] }}</td>
            <td>{{ $details['type_of_class'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
