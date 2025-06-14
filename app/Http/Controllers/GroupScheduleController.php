<?php

namespace App\Http\Controllers;

use App\Models\GroupSchedule;
use App\Models\Classes;
use App\Models\Staff;
use Illuminate\Http\Request;

class GroupScheduleController extends Controller
{
    public function index()
    {
        $schedules = GroupSchedule::with(['class', 'staff'])->orderBy('day')->orderBy('time')->get();
        return view('group-schedules.index', compact('schedules'));
    }

    public function create()
    {
        $classes = Classes::all();
        $staff = Staff::all();
        return view('group-schedules.create', compact('classes', 'staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required|string',
            'time' => 'required',
            'end_time' => 'required',
            'class_id' => 'required|exists:classes,id',
            'staff_id' => 'required|exists:staff,id',
        ]);

        GroupSchedule::create($request->only(
            ['day', 'time', 'end_time', 'class_id', 'staff_id']));

        return redirect()->route('group-schedules.index')->with(
            'success', 'Group schedule added.');
    }

    public function edit(string $id)
    {
        $schedule = GroupSchedule::findOrFail($id);
        $classes = Classes::all();
        $staff = Staff::all();
        return view('group-schedules.edit', compact('schedule', 'classes', 'staff'));
    }
    public function update(Request $request, string $id)
    {
         $request->validate([
            'day' => 'required|string',
            'time' => 'required',
            'end_time' => 'required',
            'class_id' => 'required|exists:classes,id',
            'staff_id' => 'required|exists:staff,id',
        ]);

        $schedule = GroupSchedule::findOrFail($id);
        $schedule->update($request->only(['day', 'time', 'end_time', 'class_id', 'staff_id']));

        return redirect()->route('group-schedules.index')->with('success', 'Group schedule updated.');
    }

    public function destroy(string $id)
    {
        $schedule = GroupSchedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('group-schedules.index')->with('success', 'Group schedule deleted.');
    }
}
