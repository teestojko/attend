@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/userSearch.css') }}">
@endsection

@section('content')
    <div class="search">
        <h2 class="search_name">
            {{ $user->name }}さんの勤怠情報
        </h2>
        <table class="search__table">
            <tr class="search__row">
                <th class="search__label">
                    日付
                </th>
                <th class="search__label">
                    勤務開始
                </th>
                <th class="search__label">
                    勤務終了
                </th>
                <th class="search__label">
                    休憩時間
                </th>
                <th class="search__label">
                    労働時間
                </th>
            </tr>
            @foreach ($attendances as $attendance)
                <tr class="search__row">
                    <td class="search__data">
                        {{ $attendance->date }}
                    </td>
                    <td class="search__data">
                        {{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i:s') : 'N/A' }}
                    </td>
                    <td class="search__data">
                        {{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i:s') : 'N/A' }}
                    </td>
                    @php
                        $breakHours = floor($attendance->total_break_time / 3600);
                        $breakMinutes = floor(($attendance->total_break_time % 3600) / 60);
                        $breakSeconds = $attendance->total_break_time % 60;
                        $workHours = floor($attendance->effective_work_time / 3600);
                        $workMinutes = floor(($attendance->effective_work_time % 3600) / 60);
                        $workSeconds = $attendance->effective_work_time % 60;
                    @endphp
                    <td class="search__data">
                        {{ sprintf('%02d', $breakHours) }}:{{ sprintf('%02d', $breakMinutes) }}:{{ sprintf('%02d', $breakSeconds) }}
                    </td>
                    <td class="search__data">
                        {{ sprintf('%02d', $workHours) }}:{{ sprintf('%02d', $workMinutes) }}:{{ sprintf('%02d', $workSeconds) }}
                    </td>
                </tr>
            @endforeach
        </table>
        <nav class="nav">
            {{ $attendances->links('vendor.pagination.bootstrap-4') }}
        </nav>
    </div>
@endsection
