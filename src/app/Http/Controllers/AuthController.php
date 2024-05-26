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
        $todayAttendance = $user->attendances()->where('date', Carbon::today())->first();

        $clockInDisabled = !is_null($todayAttendance) && !is_null($todayAttendance->clock_in);

        $latestRest = $todayAttendance ? $todayAttendance->rests()->latest()->first() : null;

        // Check if $latestRest is not null before accessing break_out
        $clockOutDisabled = is_null($todayAttendance) || !is_null($todayAttendance->clock_out) || ($latestRest && is_null($latestRest->break_out));

        $breakInDisabled = is_null($todayAttendance) || !is_null($todayAttendance->clock_out) || ($latestRest && is_null($latestRest->break_out));

        $breakOutDisabled = is_null($todayAttendance) || !is_null($todayAttendance->clock_out) || !$latestRest || !is_null($latestRest->break_out);

        return view('index', compact('user', 'username', 'clockInDisabled', 'clockOutDisabled', 'breakInDisabled', 'breakOutDisabled'));
    }
}
