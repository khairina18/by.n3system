<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    
   public function index(Request $request)
{
    $query = Payment::with('student')->latest();

    if ($request->has('month') && $request->month !== null) {
        $query->where('month', 'LIKE', '%' . $request->month . '%');
    }

    $payments = $query->get();
    return view('payments.index', compact('payments'));
}

    public function create()
    {
        $students = Student::all();
        return view('payments.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month' => 'required|string',
            'amount' => 'required|numeric',
            'status' => 'required|in:Paid,Pending',
            'date_paid' => 'nullable|date',
        ]);

        Payment::create($request->only([
            'student_id',
            'month',
            'amount',
            'status',
            'date_paid',
        ]));
        return redirect()->route('payments.index')->with('success', 'Payment added.');
    }

    public function edit(string $id)
    {
        $payment = Payment::findOrFail($id);
        $students = Student::all();
        return view('payments.edit', compact('payment', 'students'));
    }

    public function update(Request $request, string $id)
    {
        $payment = Payment::findOrFail($id);
        
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month' => 'required|string',
            'amount' => 'required|numeric',
            'status' => 'required|in:Paid,Pending',
            'date_paid' => 'nullable|date',
        ]);

        $payment->update($request->all());
        return redirect()->route('payments.index')->with(
            'success', 'Payment updated.');
    }

    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('payments.index')->with(
            'success', 'Payment deleted.');
    }

    public function receipt($id)
{
    $payment = Payment::with('student')->findOrFail($id);
    return view('payments.receipt', compact('payment'));
}

}
