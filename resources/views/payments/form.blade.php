<form method="POST" action="{{ isset($payment) ? route('payments.update', $payment->id) : route('payments.store') }}" style="width: 100%;">
    @csrf
    @if(isset($payment)) @method('PUT') @endif

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Student:</label>
        <select name="student_id" required>
            @foreach ($students as $student)
                <option value="{{ $student->id }}"
                    {{ old('student_id', $payment->student_id ?? '') == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Month:</label>
         <select name="month" required>
            @foreach (['January','February','March','April','May','June','July','August','September', 'October','November','December'] as $name)
                <option value="{{ $name }}" {{ old('month', $selectedMonth ?? '') == $name ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Amount (RM):</label>
        <input type="number" step="0.01" name="amount" value="{{ old('amount', $payment->amount ?? '') }}" required>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Status:</label>
        <select name="status" required>
            <option value="Paid" {{ (old('status', $payment->status ?? '') == 'Paid') ? 'selected' : '' }}>Paid</option>
            <option value="Pending" {{ (old('status', $payment->status ?? '') == 'Pending') ? 'selected' : '' }}>Pending</option>
        </select>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label>Date Paid:</label>
        <input type="date" name="date_paid" value="{{ old('date_paid', $payment->date_paid ?? '') }}">
    </div>

    <button type="submit" style="width: 100%; background-color: #4CAF50; color: white; padding: 10px; border: none; border-radius: 5px;">
        {{ isset($payment) ? 'Update' : 'Add' }} Payment
    </button>
</form>
