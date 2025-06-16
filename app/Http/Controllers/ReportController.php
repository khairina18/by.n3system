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

    $byAge = Student::select('age')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('age')
        ->orderBy('age')
        ->get();

    return view('reports.students', compact('totalStudents', 'byAge'));
}


public function classReport(Request $request)
{
    $selectedAge = $request->input('age'); // optional filter

    $subjects = ['Mathematics', 'Add Math', 'Chemistry', 'Science'];
    $classTypes = ['Group', 'One-to-One'];

    $data = [];

    foreach ($subjects as $subject) {
        foreach ($classTypes as $type) {
            $query = \App\Models\Classes::where('subject', $subject)
                ->where('type_of_class', $type);

            if ($selectedAge) {
                $query->where('age', $selectedAge);
            }

            $count = $query->withCount('students')->get()->sum('students_count');
            $data[$subject][$type] = $count;
        }
    }

    // Get all distinct ages from classes table
    $ageOptions = \App\Models\Classes::select('age')->distinct()->pluck('age')->sort();

    return view('reports.classes', compact('data', 'selectedAge', 'ageOptions'));
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
