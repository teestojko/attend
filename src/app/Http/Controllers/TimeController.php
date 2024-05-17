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
            // 既存の出勤記録があり、退勤時間がまだ記録されていない場合、退勤時間を更新
            $existingAttendance->update([
                'clock_out' => Carbon::now()->format('H:i'),
            ]);
            return back()->with('clock_out_message_success', 'お疲れ様でした！');
        } else {
            // 既に退勤時間が記録されている場合、メッセージを返す
            return back()->with('clock_out_end_message', '既に退勤されています');
        }
    } else {
        // 出勤記録が存在しない場合、メッセージを返す
        return back()->with('clock_out_message', 'まだ出勤されていません');
    }
    break;


        // case 'clock_out':
        //     $user = Auth::user();
        //     $existingClockIn = $user->attendances()->where('date', Carbon::today())->whereNotNull('clock_in')->exists();
        //     $existingClockOut = $user->attendances()->where('date', Carbon::today())->whereNotNull('clock_out')->exists();

        //     if ($existingClockIn) {
        //         $user->attendances()->create([
        //             'date' => Carbon::now()->toDateString(),
        //             'clock_out' => Carbon::now()->format('H:i'),
        //         ]);
        //     } elseif ($existingClockOut) {
        //         return back()->with('clock_out_message2', '既に退勤されています');
        //     } else {
        //         return back()->with('clock_out_message', 'まだ出勤されていません');
        //     }
        //     break;

        case 'break_in':
            $user = Auth::user();
            $user->rests()->create([
                'date' => Carbon::now()->toDateString(),
                'break_in' => Carbon::now()->format('H:i'),
            ]);
            break;

        case 'break_out':
            $user = Auth::user();
            $user->rests()->create([
                'date' => Carbon::now()->toDateString(),
                'break_out' => Carbon::now()->format('H:i'),
            ]);
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
