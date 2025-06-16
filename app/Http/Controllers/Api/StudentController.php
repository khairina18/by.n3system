<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoicePaidMail;
use App\Models\Student;
use App\Models\Invoice;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'age' => 'required|string',
            'subject' => 'required|string',
            'type' => 'required|string',
            'schedule' => 'required|string',
            'email' => 'required|email',
            'amount' => 'required|numeric',
        ]);

        // Save Student
        $student = Student::create([
            'name' => $request->name,
            'age' => $request->age,
            'subject' => $request->subject,
            'type' => $request->type,
            'schedule' => $request->schedule,
            'parent_email' => $request->email,
        ]);

        //  Create Invoice
        $invoice = Invoice::create([
            'student_id' => $student->id,
            'amount' => $request->amount,
            'status' => 'Paid',
        ]);

        // Send Email to Parent
        Mail::to($request->email)->send(new InvoicePaidMail($invoice));

        // Return response
        return response()->json([
            'message' => 'Student registered and invoice sent successfully!',
            'student' => $student,
            'invoice' => $invoice,
        ], 201);
    }

    public function myClasses(Request $request)
    {
        $email = $request->query('email');

        if (!$email) {
            return response()->json(['message' => 'Email is required'], 400);
        }

        $students = Student::where('parent_email', $email)
            ->latest()
            ->get();

        return response()->json($students);
    }
}
