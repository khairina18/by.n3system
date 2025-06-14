<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::all();
        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',

        ]);

        Staff::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => 'Tutor',
        ]);

        return redirect()->route('staff.index')->with('success', 
        'Staff added successfully.');
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
         $staff = Staff::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
        ]);

        $staff->update($request->all());
        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff removed.');
    }
}
