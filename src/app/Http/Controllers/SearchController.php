<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class SearchController extends Controller
{
    public function attendanceByDate($date)
    {
        $attendances = Attendance::with('user', 'rests')
            ->whereDate('date', $date)
            ->paginate(5);

        foreach ($attendances as $attendance) {
            if ($attendance->clock_in && $attendance->clock_out) {
                $attendance->total_break_time = app('App\Http\Controllers\AttendanceController')->calculateTotalBreakTime($attendance);
                $attendance->effective_work_time = app('App\Http\Controllers\AttendanceController')->calculateEffectiveWorkTime($attendance);
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
                $attendance->total_break_time = app('App\Http\Controllers\AttendanceController')->calculateTotalBreakTime($attendance);
                $attendance->effective_work_time = app('App\Http\Controllers\AttendanceController')->calculateEffectiveWorkTime($attendance);
            } else {
                $attendance->total_break_time = 0;
                $attendance->effective_work_time = 0;
            }
        }

        return view('userSearch', compact('user', 'attendances'));
    }
}
