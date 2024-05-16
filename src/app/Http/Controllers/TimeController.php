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
                // すでにclock_inが打刻されている場合の処理
            } else {
                $user->attendances()->create([
                    'date' => Carbon::now()->toDateString(),
                    'clock_in' => Carbon::now()->format('H:i'),
                ]);
            }
            break;

        case 'clock_out':
            $user = Auth::user();
            $existingClockIn = $user->attendances()->where('date', Carbon::today())->whereNotNull('clock_in')->exists();

            $user->attendances()->create([
                'date' => Carbon::now()->toDateString(),
                'clock_out' => Carbon::now()->format('H:i'),
            ]);

            break;

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
