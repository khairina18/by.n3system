<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = Classes::all();
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        $classCodeOptions = config('classcodes');
        return view('classes.create', compact('classCodeOptions'));
    }

    public function store(Request $request)
    {
        $classCodeOptions = config('classcodes');

        $request->validate([
            'code' => 'required|in:' . implode(',', array_keys($classCodeOptions)),
        ]);

        $classDetails = $classCodeOptions[$request->code];

        Classes::create([
            'code' => $request->code,
            'subject' => $classDetails['subject'],
            'age' => $classDetails['age'],
            'type_of_class' => $classDetails['type_of_class'],
            'fee_per_hour' => $classDetails['fee_per_hour'],
        ]);

        return redirect()->route('classes.index')->with('success', 'Class added successfully.');
    }

    public function edit(Classes $class)
    {
        $classCodeOptions = config('classcodes');
        return view('classes.edit', compact('class', 'classCodeOptions'));
    }

    public function update(Request $request, Classes $class)
    {
        $classCodeOptions = config('classcodes');
        
        $request->validate([
            'code' => 'required|in:' . implode(',', array_keys(config('classcodes'))),
        ]);

        $classDetails = $classCodeOptions[$request->code];

        $class->update([
            'code' => $request->code,
            'subject' => $classDetails['subject'],
            'age' => $classDetails['age'],
            'type_of_class' => $classDetails['type_of_class'],
            'fee_per_hour' => $classDetails['fee_per_hour'],
        ]);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy(Classes $class)
    {
        $class->delete();
        return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
    }

    public function getFee(Request $request)
    {
        $subject = $request->subject;
        $type = $request->type;

        // Example hardcoded logic — replace with DB lookup if needed
        if ($type === 'Group') {
            $fee = 30;
        } elseif ($type === 'One-to-One') {
            $fee = 60;
        } else {
            return response()->json(['fee' => null], 404);
        }

        return response()->json(['fee' => $fee]);
    }
    public function getFormOptions()
{
    $subjects = Classes::select('subject')->distinct()->pluck('subject');
    $types = Classes::select('type_of_class')->distinct()->pluck('type_of_class');

    return response()->json([
        'subjects' => $subjects,
        'types' => $types,
    ]);
}
}
