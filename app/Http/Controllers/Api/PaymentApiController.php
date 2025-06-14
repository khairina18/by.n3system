<?php

namespace App\Http\Controllers\Api;

use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentApiController extends Controller
{
    // View payments by student
    public function index($student_id)
    {
        $payments = Payment::where('student_id', $student_id)
                    ->orderBy('month', 'desc')
                    ->get();

        return response()->json($payments);
    }

    // Make a payment (simulate submission)
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $payment = Payment::create([
            'student_id' => $request->student_id,
            'month' => $request->month,
            'amount' => $request->amount,
            'status' => 'Paid',
            'date_paid' => now()
        ]);

        return response()->json([
            'message' => 'Payment recorded successfully',
            'data' => $payment
        ], 201);
    }
}
