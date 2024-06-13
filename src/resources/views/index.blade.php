@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

@endsection


@section('content')
    <div class="attendance">
        @if (!is_null($username))
            <p class='message'>{{ $username }}さん、お疲れ様です！</p>
        @endif

        <div class="attendance__content">
            <div class="attendance__panel">
                <form class="attendance__button" action="/save" method="post">
                    @csrf
                    <button class="attendance__button-submit" type="submit" name="action" value="clock_in" {{ $clockInDisabled ?? false ? 'disabled' : '' }}>勤務開始</button>
                </form>

                <form class="attendance__button" action="/save" method="post">
                    @csrf
                    <button class="attendance__button-submit" type="submit" name="action" value="clock_out" {{ $clockOutDisabled ?? false ? 'disabled' : '' }}>勤務終了</button>
                </form>
            </div>

            <div class="attendance__panel">
                <form class="attendance__button" action="/rest/save" method="post">
                    @csrf
                    <button class="attendance__button-submit" type="submit" name="action" value="break_in" {{ $breakInDisabled ?? false ? 'disabled' : '' }}>休憩開始</button>
                </form>

                <form class="attendance__button" action="/rest/save" method="post">
                    @csrf
                    <button class="attendance__button-submit" type="submit" name="action" value="break_out" {{ $breakOutDisabled ?? false ? 'disabled' : '' }}>休憩終了</button>
                </form>
            </div>
        </div>

        <div class="attendance__alert">
            @if (session('error'))
                <span class="attendance__alert--success">
                    {{ session('error')}}
                </span>
            @endif
        </div>

        <div class="attendance__alert">
            @if (session('message'))
                <span class="attendance__alert--success">
                    {{ session('message')}}
                </span>
            @endif
        </div>
    </div>
@endsection
