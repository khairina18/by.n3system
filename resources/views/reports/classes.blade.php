@extends('layouts.app')

@section('content')
    <div class="report-section">
        <h2>Class Allocation Report</h2>

        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Type</th>
                    <th>Age</th>
                    <th>Student Count</th>
                    <th>Tutor</th>
                </tr>
        </thead>
        <tbody>
            @foreach ($classes as $class)
                <tr>
                    <td>{{ $class->subject }}</td>
                    <td>{{ $class->type_of_class }}</td>
                    <td>{{ $class->age }}</td>
                    <td>{{ $class->students_count ?? 'N/A' }}</td>
                    <td>{{ $class->tutor->name ?? 'Not assigned' }}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
@endsection
