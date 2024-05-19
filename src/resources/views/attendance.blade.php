@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    @foreach ($attendances as $attendance)
        <p>名前: {{ $attendance->user->name }}</p>
        <p>日付: {{ $attendance->created_at->toDateString() }}</p>
        <p>勤務開始: {{ $attendance->clock_in ? $attendance->clock_in->format('H:i:s') : 'N/A' }}</p>
        <p>勤務終了: {{ $attendance->clock_out ? $attendance->clock_out->format('H:i:s') : 'N/A' }}</p>

        @php
            $breakHours = floor($attendance->total_break_time / 3600);
            $breakMinutes = floor(($attendance->total_break_time % 3600) / 60);
            $breakSeconds = $attendance->total_break_time % 60;

            $workHours = floor($attendance->effective_work_time / 3600);
            $workMinutes = floor(($attendance->effective_work_time % 3600) / 60);
            $workSeconds = $attendance->effective_work_time % 60;
        @endphp

        <p>休憩時間 {{ $breakHours }} : {{ $breakMinutes }} : {{ $breakSeconds }} </p>
        <p>労働時間 {{ $workHours }} : {{ $workMinutes }} : {{ $workSeconds }} </p>
    @endforeach
@endsection
