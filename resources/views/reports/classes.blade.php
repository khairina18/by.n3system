@extends('layouts.app')

@section('content')
    <div class="report-section">
        <h2>Class Allocation Report</h2>

        {{-- Filter by Age --}}
        <form method="GET" action="{{ route('reports.classes') }}" style="margin-bottom: 20px;">
            <label for="age">Filter by Age:</label>
            <select name="age" id="age" onchange="this.form.submit()">
                <option value="">All Ages</option>
                @foreach ($ageOptions as $age)
                    <option value="{{ $age }}" {{ $selectedAge === $age ? 'selected' : '' }}>
                        {{ $age }}
                    </option>
                @endforeach
            </select>
        </form>

        {{-- Display chart-style summary --}}
        @foreach ($data as $subject => $counts)
            <h4>{{ $subject }}</h4>
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-bottom: 20px;">
                <thead>
                    <tr>
                        <th>Class Type</th>
                        <th>Student Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($counts as $type => $count)
                        <tr>
                            <td>{{ $type }}</td>
                            <td>{{ $count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

        @if(empty($data))
            <p>No data available.</p>
        @endif
    </div>
@endsection
