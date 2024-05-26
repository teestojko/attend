<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function index()
    {
        // $users = User::Paginate(10);
        // return view('index', compact('users'));
        $username = null;
        if (auth()->check()) {
            $username = auth()->user()->name;
        }

        $user = Auth::user();
// dd($user);
        $todayAttendance = $user->attendances()->where('date', Carbon::today())->first();
// dd($todayAttendance);
        $clockInDisabled = !is_null($todayAttendance) && !is_null($todayAttendance->clock_in);
// dd($clockInDisabled);
        $clockOutDisabled = is_null($todayAttendance) || !is_null($todayAttendance->clock_out);
// dd($clockOutDisabled);
        $latestRest = $todayAttendance ? $todayAttendance->rests()->latest()->first() : null;
// dd($latestRest);
        $breakInDisabled = is_null($todayAttendance) || !is_null($todayAttendance->clock_out) || ($latestRest && is_null($latestRest->break_out));
// dd($clockOutDisabled);
        $breakOutDisabled = is_null($todayAttendance) || !is_null($todayAttendance->clock_out) || !$latestRest || !is_null($latestRest->break_out);
// dd($breakOutDisabled);
        // $users = User::paginate(3);
        return view('index', compact('user', 'username','clockInDisabled', 'clockOutDisabled', 'breakInDisabled', 'breakOutDisabled'));
    }
}
