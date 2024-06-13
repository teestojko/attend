<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
    $action = $request->input('action');
        switch ($action) {
            case 'clock_in':
                $user = Auth::user();
                $existingClockIn = $user->attendances()->where('date', Carbon::today())->whereNotNull('clock_in')->exists();
                if ($existingClockIn) {
                    return back()->with('error', '既に出勤されています');
                } else {
                    $user->attendances()->create([
                        'date' => Carbon::now()->toDateString(),
                        'clock_in' => Carbon::now()->format('H:i:s'),
                    ]);
                    return back()->with('message', 'おはようございます！');
                }
            break;

            case 'clock_out':
                $user = Auth::user();
                $today = Carbon::today()->toDateString();
                $existingAttendance = $user->attendances()->where('date', $today)->first();
                if ($existingAttendance) {
                    if (is_null($existingAttendance->clock_out)) {
                        $existingAttendance->update([
                        'clock_out' => Carbon::now()->format('H:i:s'),
                        ]);
                        return back()->with('message', 'お疲れ様でした！');
                    } else {
                        return back()->with('error', '既に退勤されています');
                    }
                } else {
                    return back()->with('error', 'まだ出勤されていません');
                }
            break;
        }
    return back();
    }
}
