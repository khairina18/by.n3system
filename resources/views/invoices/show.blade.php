@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Invoice #{{ $invoice->id }}</h2>

    <p><strong>Student:</strong> {{ $invoice->student->name }}</p>
    <p><strong>Email:</strong> {{ $invoice->student->parent_email }}</p>
    <p><strong>Subject:</strong> {{ $invoice->student->subject }}</p>
    <p><strong>Schedule:</strong> {{ $invoice->student->schedule }}</p>
    <p><strong>Amount:</strong> RM{{ number_format($invoice->amount, 2) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>

    <a href="{{ route('invoices.download', $invoice->id) }}" class="btn btn-primary">Download PDF</a>
</div>
@endsection
