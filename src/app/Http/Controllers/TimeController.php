<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Date;

class TimeController extends Controller
{
    public function index()
    {
        $users = User::with('attendances.rests')->get();
        dd($users);

        return view('index', compact('users'));
    }

    public function store(Request $request)
    {
    $action = $request->input('action');//form button ravel のname"" と('')の記述を合わせる

        switch ($action) {
        case 'clock_in':
            $user = Auth::user();
            $existingClockIn = $user->attendances()->where('date', Carbon::today())->whereNotNull('clock_in')->exists();

            if ($existingClockIn) {
                return back()->with('clock_in_message', '既に出勤されています');
            } else {
                $user->attendances()->create([
                    'date' => Carbon::now()->toDateString(),
                    'clock_in' => Carbon::now()->format('H:i'),
                ]);
                return back()->with('clock_in_first_message', 'おはようございます！');
            }
            break;

        case 'clock_out':
            $user = Auth::user();
            $today = Carbon::today()->toDateString();
            $existingAttendance = $user->attendances()->where('date', $today)->first();

        if ($existingAttendance) {
            if (is_null($existingAttendance->clock_out)) {
                $existingAttendance->update([
                    'clock_out' => Carbon::now()->format('H:i'),
                ]);
                return back()->with('clock_out_message_success', 'お疲れ様でした！');
            } else {
                return back()->with('clock_out_end_message', '既に退勤されています');
            }
        } else {
            return back()->with('clock_out_message', 'まだ出勤されていません');
        }
                break;

        case 'break_in':
    $user = Auth::user();
    $attendance = $user->attendances()->where('date', Carbon::today())->first();

    if ($attendance) {
        $latestRest = $attendance->rests()->latest()->first();
        if ($latestRest && $latestRest->break_out) {
            $attendance->rests()->create([
                'break_in' => Carbon::now()->format('H:i'),
            ]);
        } else {
            return back()->with('error', '最新の休憩が終了していないか、休憩が開始されていません');
        }
    } else {
        return back()->with('error', 'まだ出勤していません');
    }
    break;

        // case 'break_in':
        //     $attendance = Auth::user()->attendances()->where('date', Carbon::today())->first();
        // if ($attendance) {
        //     $attendance->rests()->create([
        //         'break_in' => Carbon::now()->format('H:i'),
        //     ]);
        // } else {
        //         return back()->with('error', 'まだ出勤していません');
        // }
        //     break;


        case 'break_out':
            $attendance = Auth::user()->attendances()->where('date', Carbon::today())->first();
        if ($attendance) {
            if (is_null($attendance->break_out)) {
                $attendance->rests()->create([
                    'break_out' => Carbon::now()->format('H:i'),
                ]);
                return back()->with('clock_out_message_success', 'お疲れ様でした！');
            } else {
                return back()->with('clock_out_end_message', '既に退勤されています');
            }
            } else {
            return back()->with('clock_out_message', 'まだ出勤されていません');
            }
                break;

        default:
            // その他の処理
            break;
    }

    // 必要に応じてリダイレクトなどの処理を追加
    return back();
    // ->with('message', '送信されました');
    }
}
