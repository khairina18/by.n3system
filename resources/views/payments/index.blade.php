@extends('layouts.app')

@section('content')
    <h1>Manage Payments</h1>
    <a href="{{ route('payments.create') }}" class="btn btn-add">Add New Payment</a>
    
    <form method="GET" action="{{ route('payments.index') }}" style="margin-bottom: 20px;">
    <label for="month">Filter by Month:</label>
    <input type="text" name="month" id="month" placeholder="e.g: January" value="{{ request('month') }}">
    <button type="submit" class="btn">Search</button>
    <a href="{{ route('payments.index') }}" class="btn btn-delete">Reset</a>
    </form>
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Month</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date Paid</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ $payment->student->name }}</td>
                    <td>{{ $payment->month }}</td>
                    <td>RM{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>{{ $payment->date_paid ?? '-' }}</td>
                    <td>
                        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-delete" onclick="return confirm('Delete this payment?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No payment records found.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
