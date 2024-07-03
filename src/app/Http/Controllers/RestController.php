<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RestController extends Controller
{
    public function store(Request $request)
    {
    $action = $request->input('action');
        switch ($action) {
            case 'break_in':
                $user = Auth::user();
                $attendance = $user->attendances()->where('date', Carbon::today())->first();
                if ($attendance) {
                    if ($attendance->clock_out) {
                        return back()->with('error', '勤務終了後に休憩開始はできません');
                    }
                        $latestRest = $attendance->rests()->latest()->first();
                    if (!$latestRest || ($latestRest && $latestRest->break_out)) {
                        $attendance->rests()->create([
                            'break_in' => Carbon::now()->format('H:i:s'),
                        ]);
                    } else {
                        return back()->with('error', '最新の休憩が終了していないか、休憩が開始されていません');
                    }
                } else {
                    return back()->with('error', 'まだ出勤していません');
                }
            break;

            case 'break_out':
                $user = Auth::user();
                $attendance = $user->attendances()->where('date', Carbon::today())->first();
                if ($attendance) {
                    if ($attendance->clock_in && is_null($attendance->clock_out)) {
                        $latestRest = $attendance->rests()->latest()->first();
                        if ($latestRest && $latestRest->break_in && is_null($latestRest->break_out)) {
                            $latestRest->update([
                                'break_out' => Carbon::now()->format('H:i:s'),
                            ]);
                            return back()->with('message', '無理せず頑張りましょう！');
                        } else {
                            return back()->with('error', 'もう休憩終わってますよ！');
                        }
                    } else {
                        return back()->with('error', '既に退勤が押されています');
                    }
                } else {
                    return back()->with('error', 'まだ出勤が押されていません');
                }
            break;
        }
    return back();
    }
}
