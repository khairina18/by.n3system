<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\GroupSchedule;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function filter(Request $request)
    {
        $age = $request->age;
        $subject = $request->subject;
        $type = $request->type;

        if (!$age || !$subject || !$type) {
            return response()->json([], 400);
        }

        if (strtolower($type) === 'group' || strtolower($type) === 'group session') {
            $groupSchedules = GroupSchedule::with('class', 'staff')
                ->whereHas('class', function ($query) use ($age, $subject) {
                    $query->where('age', $age)
                          ->where('subject', $subject)
                          ->where('type_of_class', 'Group');
                })
                ->get();

            return response()->json($groupSchedules);
        }

        $schedules = Schedule::with('class', 'staff')
            ->whereHas('class', function ($query) use ($age, $subject) {
                $query->where('age', $age)
                      ->where('subject', $subject)
                      ->where('type_of_class', 'One-to-One');
            })
            ->where('is_booked', false)
            ->get();

        return response()->json($schedules);
    }
}
