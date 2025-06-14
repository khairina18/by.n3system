@extends('layouts.app')

@section('content')
    <div class="report-section">
    <h2>Payment Report</h2>

    <form method="GET">
        <label for="month">Filter by Month:</label>
        <input type="text" name="month" placeholder="e.g., May" value="{{ $month }}">
        <button type="submit">Filter</button>
    </form>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                <th>Student</th>
                <th>Month</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $pay)
                <tr>
                    <td>{{ $pay->student->name ?? 'Unknown' }}</td>
                    <td>{{ $pay->month }}</td>
                    <td>RM{{ number_format($pay->amount, 2) }}</td>
                    <td>{{ $pay->status }}</td>
                    <td>{{ $pay->date_paid ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
