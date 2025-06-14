<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    ]);

    $student = \App\Models\Student::create([
        'name' => $request->name,
        'age' => $request->age,
        'subject' => $request->subject,
        'type' => $request->type,
        'schedule' => $request->schedule,
        'parent_email' => $request->email,
    ]);

    return response()->json([
        'message' => 'Student added successfully!',
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

    $students = \App\Models\Student::where('parent_email', $email)
        ->latest()
        ->get();

    return response()->json($students);
}


}
