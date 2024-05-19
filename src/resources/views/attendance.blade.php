@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    @foreach ($attendances as $attendance)
        <p>名前: {{ $attendance->user->name }}</p>
        <p>日付: {{ \Carbon\Carbon::parse($attendance->date)->toDateString() }}</p>
        <p>勤務開始: {{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i:s') : 'N/A' }}</p>
        <p>勤務終了: {{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i:s') : 'N/A' }}</p>

        @php
            $breakHours = floor($attendance->total_break_time / 3600);
            $breakMinutes = floor(($attendance->total_break_time % 3600) / 60);
            $breakSeconds = $attendance->total_break_time % 60;

            $workHours = floor($attendance->effective_work_time / 3600);
            $workMinutes = floor(($attendance->effective_work_time % 3600) / 60);
            $workSeconds = $attendance->effective_work_time % 60;
        @endphp

        <p>休憩時間: {{ sprintf('%02d', $breakHours) }}:{{ sprintf('%02d', $breakMinutes) }}:{{ sprintf('%02d', $breakSeconds) }}</p>
        <p>労働時間: {{ sprintf('%02d', $workHours) }}:{{ sprintf('%02d', $workMinutes) }}:{{ sprintf('%02d', $workSeconds) }}</p>
    @endforeach
@endsection
