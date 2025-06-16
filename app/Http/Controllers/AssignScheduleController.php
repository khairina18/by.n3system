<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ScheduleAssignment;
use Illuminate\Http\Request;

class AssignScheduleController extends Controller
{
    public function index()
    {
        $assignments = ScheduleAssignment::with('student')->get();
        return view('assign_schedule.index', compact('assignments'));
    }

    public function create()
    {
        $students = Student::doesntHave('scheduleAssignment')->get(); // only unassigned
        $classCodes = config('classcodes');

        return view('assign_schedule.create', compact('students', 'classCodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_code' => 'required',
        ]);

        $assignment = ScheduleAssignment::create($request->only(['student_id', 'class_code']));

        return redirect()->route('assign_schedule.index')->with('success', 'Schedule assigned successfully.');
    }
}
