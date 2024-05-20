@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <p>{{ date('Y-m-d') }}</p>

@foreach ($attendances as $attendance)
    <table class="attendance__table">
            <tr class="attendance__row">
                <th class="attendance__label">名前</th>
                <th class="attendance__label">勤務開始</th>
                <th class="attendance__label">勤務終了</th>
                <th class="attendance__label">休憩時間</th>
                <th class="attendance__label">労働時間</th>
            </tr>

            <tr class="attendance__row">

                <td class="attendance__data">
                    {{ $attendance->user->name }}</td>

                <td class="attendance__data">
                    {{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i:s') : 'N/A' }}</td>

                <td class="attendance__data">
                    {{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i:s') : 'N/A' }}</td>

        @php
            $breakHours = floor($attendance->total_break_time / 3600);
                $breakMinutes = floor(($attendance->total_break_time % 3600) / 60);
            $breakSeconds = $attendance->total_break_time % 60;

            $workHours = floor($attendance->effective_work_time / 3600);
            $workMinutes = floor(($attendance->effective_work_time % 3600) / 60);
            $workSeconds = $attendance->effective_work_time % 60;
        @endphp

                <td class="attendance__data">
                    {{ sprintf('%02d', $breakHours) }}:{{ sprintf('%02d', $breakMinutes) }}:{{ sprintf('%02d', $breakSeconds) }}</td>

                <td class="attendance__data">
                    {{ sprintf('%02d', $workHours) }}:{{ sprintf('%02d', $workMinutes) }}:{{ sprintf('%02d', $workSeconds) }}</td>
            </tr>
    </table>

            {{-- <p>名前: {{ $attendance->user->name }}</p>
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
            <p>労働時間: {{ sprintf('%02d', $workHours) }}:{{ sprintf('%02d', $workMinutes) }}:{{ sprintf('%02d', $workSeconds) }}</p> --}}
        @endforeach
@endsection
