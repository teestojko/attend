<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class AttendanceController extends Controller
{
        public function attendance(Request $request)
    {
        $today = Carbon::now()->toDateString();
        $attendances = Attendance::with('user', 'rests')
        ->whereDate('date', $today)
        ->paginate(5);

        foreach ($attendances as $attendance) {
            if ($attendance->clock_in && $attendance->clock_out) {
                $attendance->total_break_time = $this->calculateTotalBreakTime($attendance);
                $attendance->effective_work_time = $this->calculateEffectiveWorkTime($attendance);
            } else {
                $attendance->total_break_time = 0;
                $attendance->effective_work_time = 0;
            }
        }

    return view('attendance', compact('attendances'));
    }

    public function calculateTotalBreakTime($attendance)
    {
        $totalBreakTime = 0;

        foreach ($attendance->rests as $rest) {
            $breakIn = Carbon::parse($rest->break_in);
            $breakOut = Carbon::parse($rest->break_out);
            if ($breakIn && $breakOut) {
                $totalBreakTime += $breakOut->diffInSeconds($breakIn);
            }
        }

    return $totalBreakTime;
    }

    public function calculateEffectiveWorkTime($attendance)
    {
        if ($attendance->clock_in && $attendance->clock_out) {
            $clockIn = Carbon::parse($attendance->clock_in);
            $clockOut = Carbon::parse($attendance->clock_out);

            $totalWorkTime = $clockOut->diffInSeconds($clockIn);
            $totalBreakTime = $this->calculateTotalBreakTime($attendance);

            return $totalWorkTime - $totalBreakTime;
        }

    return 0;
    }



    public function attendanceByDate($date)
    {
        $attendances = Attendance::with('user', 'rests')
            ->whereDate('date', $date)
            ->paginate(5);

        foreach ($attendances as $attendance) {
            if ($attendance->clock_in && $attendance->clock_out) {
                $attendance->total_break_time = $this->calculateTotalBreakTime($attendance);
                $attendance->effective_work_time = $this->calculateEffectiveWorkTime($attendance);
            } else {
                $attendance->total_break_time = 0;
                $attendance->effective_work_time = 0;
            }
        }

        return view('attendance', compact('attendances', 'date'));
    }


    public function userList()
    {
        $users = User::paginate(5);
        return view('userList', compact('users'));
    }


    public function userAttendance($userId)
    {
        $user = User::findOrFail($userId);

        $attendances = $user->attendances()->with('rests')->paginate(2);

        foreach ($attendances as $attendance) {
            if ($attendance->clock_in && $attendance->clock_out) {
                $attendance->total_break_time = $this->calculateTotalBreakTime($attendance);
                $attendance->effective_work_time = $this->calculateEffectiveWorkTime($attendance);
            } else {
                $attendance->total_break_time = 0;
                $attendance->effective_work_time = 0;
            }
        }

    return view('userSearch', compact('user', 'attendances'));
    }

}
