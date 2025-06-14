@extends('layouts.app')

@section('content')
<div class="report-section">
    <h2>Student Summary Report</h2>
    <p><strong>Total Students:</strong> {{ $totalStudents }}</p>

    <h4>By Class Type</h4>
    <ul>
        @foreach($byClassType as $item)
            <li>{{ $item->type_of_class }}: {{ $item->total }}</li>
        @endforeach
    </ul>

    <h4>By Age Range</h4>
    <ul>
        @foreach($byAgeRange as $item)
            <li>{{ $item->age_range }}: {{ $item->total }}</li>
        @endforeach
    </ul>
</div>
@endsection
