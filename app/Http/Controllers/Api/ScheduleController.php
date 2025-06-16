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
        //groupschedule
        if (strtolower($type) === 'group' || strtolower($type) === 'group session') {
            $groupSchedules = GroupSchedule::with('class', 'staff')
                ->whereHas('class', function ($query) use ($age, $subject) {
                    $query->where('age', $age)
                          ->where('subject', $subject)
                          ->where('type_of_class', 'Group');
                })
                ->get();

            return response()->json($groupSchedules ->map(function ($schedule) {
                return [
                    'id' => $schedule->id,
                    'day' => $schedule->day,
                    'time' => $schedule->time,
                    'end_time' => $schedule->end_time,
                    'date' => null, // No date for group, handled as null
                    'staff' => [
                        'name' => $schedule->staff->name,
                    ],
                    'class' => [
                        'subject' => $schedule->class->subject,
                        'age' => $schedule->class->age,
                    ],
                ];
            }));
        }
        //onetooneschedule
        $schedules = Schedule::with('class', 'staff')
            ->whereHas('class', function ($query) use ($age, $subject) {
                $query->where('age', $age)
                      ->where('subject', $subject)
                      ->where('type_of_class', 'One-to-One');
            })
            ->where('is_booked', false)
            ->get();

        return response()->json($schedules ->map(function ($schedule) {
            return [
                'id' => $schedule->id,
                'date' => $schedule->date, 
                'day' => $schedule->day,
                'time' => $schedule->time,
                'end_time' => $schedule->end_time,
                'staff' => [
                    'name' => $schedule->staff->name,
                ],
                'class' => [
                    'subject' => $schedule->class->subject,
                    'age' => $schedule->class->age,
                ],
            ];
        }));
    }
}