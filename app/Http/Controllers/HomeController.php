<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Schedule;
use App\Models\GroupSchedule;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
{
    $selectedDate = $request->input('date') ?? Carbon::today()->toDateString();
    $sessionType = $request->input('session') ?? 'group'; //default group session display
    $today = Carbon::now()->format('l'); // e.g. Monday

    $cacheKey = 'dashboard_' . auth()->id(). '_'.$selectedDate. '_'. $sessionType;

    try {
         $data = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($selectedDate, $sessionType, $today) {
            $baseData = [
                'totalStudents' => Student::count(),
                'totalClasses' => Classes::count(),
                'selectedDate' => $selectedDate,
                'sessionType' => $sessionType,
                'today' => $today,
            ];

            if ($sessionType === 'group') {
                $baseData['groupSchedule'] = GroupSchedule::with(['class', 'staff'])
                    ->where('day', $today)
                    ->orderBy('time')
                    ->get();
                $baseData['timetable'] = collect(); // empty one-to-one
            } else {
                $baseData['timetable'] = Schedule::with(['class', 'staff'])
                    ->whereDate('date', $selectedDate)
                    ->orderBy('time')
                    ->get();
                $baseData['groupSchedule'] = collect(); // empty group
            }

            return $baseData;
        });

        return view('home', $data);

    } catch (\Exception $e) {
        Log::error('Dashboard error: ' . $e->getMessage());

        return view('home', [
            'totalStudents' => 0,
            'totalClasses' => 0,
            'selectedDate' => $selectedDate,
            'sessionType' => $sessionType,
            'groupSchedule' => collect(),
            'timetable' => collect(),
            'today' => $today,
            'errors' => new \Illuminate\Support\MessageBag([
                'dashboard' => 'Dashboard data temporarily unavailable'
            ])
        ]);
    }
}

}