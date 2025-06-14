<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Staff;
use App\Models\Classes;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('class', 'staff')->latest()->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $classes = Classes::all();
        $staff = Staff::all();
        return view('schedules.create', compact('classes', 'staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'date' => 'required|date',
        'day' => 'required',
        'time' => 'required',
        'end_time' => 'required',
        'class_id' => 'nullable|exists:classes,id',
        'staff_id' => 'required|exists:staff,id',
        'is_booked' => 'boolean',

    ]);

     // Extract day from selected date
    $date = Carbon::parse($request->date);
    $dayOfWeek = $date->format('l'); // e.g. Monday

    // Check group session conflicts
    $conflict = \App\Models\GroupSchedule::where('day', $dayOfWeek)
        ->where('staff_id', $request->staff_id)
        ->where(function ($query) use ($request) {
            $query->where('time', '<', $request->end_time)
                  ->where('end_time', '>', $request->time);
        })
        ->exists();

    if ($conflict) {
        return back()->withErrors(['staff_id' => 'This tutor has a group class at this time. Choose another time or tutor.'])->withInput();
    }

    // Save schedule if no conflict
    Schedule::create($request->only([
        'date', 'day', 'time', 'end_time', 'class_id', 'staff_id'
    ]) + ['is_booked' => false]);

    return redirect()->route('schedules.index')->with('success', 'Schedule added successfully.');
}

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $classes = Classes::all();
        $staff = Staff::all();
        return view('schedules.edit', compact('schedule', 'classes','staff'));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $request->validate([
            'date' => 'required|date',
            'day' => 'required|string',
            'time' => 'required',
            'end_time' => 'required',
            'class_id' => 'required|exists:classes,id',
            'staff_id' => 'required|exists:staff,id',
        ]);

        $schedule->update($request->only([
            'date',
            'day',
            'time',
            'end_time',
            'class_id',
            'staff_id',
        ]));
        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted.');
    }
}
