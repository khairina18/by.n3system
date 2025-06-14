<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Payment;


class ReportController extends Controller
{
    //
    public function studentReport()
{
    $totalStudents = Student::count();

    $byClassType = Student::join(
    'classes', 'students.id', '=', 'classes.id')
        ->select('classes.type_of_class')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('classes.type_of_class')
        ->get();

    $byAgeRange = Student::selectRaw("
            CASE 
                WHEN age BETWEEN 7 AND 9 THEN '7-9'
                WHEN age BETWEEN 10 AND 12 THEN '10-12'
                WHEN age BETWEEN 13 AND 15 THEN '13-15'
                ELSE '16+'
            END as age_range
        ")
        ->selectRaw('COUNT(*) as total')
        ->groupBy('age_range')
        ->get();

    return view('reports.students', 
    compact('totalStudents', 'byClassType', 'byAgeRange'));
}

public function classReport()
{
    $classes = Classes::withCount('students') 
        ->with('tutor') 
        ->get();

    return view('reports.classes', compact('classes'));
}

public function paymentReport(Request $request)
{
    $month = $request->input('month'); // optional filter

    $query = Payment::with('student')->latest();

    if ($month) {
        $query->where('month', 'like', '%' . $month . '%');
    }

    $payments = $query->get();

    return view('reports.payments', compact('payments', 'month'));
}
}
