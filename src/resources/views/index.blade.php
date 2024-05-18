@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('link')
    <nav>
        <ul class="header-nav">
            @if (Auth::check())
            <li class="header-nav__item">
                <a class="header-nav__link" href="/">ホーム</a>
            </li>
            <li class="header-nav__item">
                <a class="header-nav__link2" href="/attendance">日付一覧</a>
                </li>
            <li class="header-nav__item">
                <form class="form" action="/logout" method="post">
                @csrf
                    <button class="header-nav__button">ログアウト</button>
                </form>
            </li>
            @endif
        </ul>
    </nav>
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
                    <button class="attendance__button-submit" type="submit" name="action" value="clock_in">勤務開始</button>
                </form>

                <form class="attendance__button" action="/save" method="post">
                    @csrf
                    <button class="attendance__button-submit" type="submit" name="action" value="clock_out">勤務終了</button>
                </form>
            </div>

            <div class="attendance__panel">
                <form class="attendance__button" action="/save" method="post">
                    @csrf
                    <button class="attendance__button-submit" type="submit" name="action" value="break_in">休憩開始</button>
                </form>

                <form class="attendance__button" action="/save" method="post">
                    @csrf
                    <button class="attendance__button-submit" type="submit" name="action" value="break_out">休憩終了</button>
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

@endsection
