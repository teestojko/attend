@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="index">
        <div class="index-message">
            @if (!is_null($username))
                <p class='user-message'>
                    {{ $username }}さん、お疲れ様です！
                </p>
            @endif
        </div>
        <div class="index-inner">
            <div class="index__content">
                <div class="index__panel">
                    <form class="index__button" action="/save" method="post">
                    @csrf
                        <button class="index__button-submit" type="submit" name="action" value="clock_in" {{ $clockInDisabled ?? false ? 'disabled' : '' }}>
                            勤務開始
                        </button>
                    </form>
                    <form class="index__button" action="/save" method="post">
                    @csrf
                        <button class="index__button-submit" type="submit" name="action" value="clock_out" {{ $clockOutDisabled ?? false ? 'disabled' : '' }}>
                            勤務終了
                        </button>
                    </form>
                </div>
                <div class="index__panel">
                    <form class="index__button" action="/rest/save" method="post">
                    @csrf
                        <button class="index__button-submit" type="submit" name="action" value="break_in" {{ $breakInDisabled ?? false ? 'disabled' : '' }}>
                            休憩開始
                        </button>
                    </form>
                    <form class="index__button" action="/rest/save" method="post">
                    @csrf
                        <button class="index__button-submit" type="submit" name="action" value="break_out" {{ $breakOutDisabled ?? false ? 'disabled' : '' }}>
                            休憩終了
                        </button>
                    </form>
                </div>
            </div>
            <div class="index__alert">
                @if (session('error'))
                    <span class="index__alert--success">
                        {{ session('error')}}
                    </span>
                @endif
            </div>
            <div class="index__alert">
                @if (session('message'))
                    <span class="index__alert--success">
                        {{ session('message')}}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("mousemove", (e) => {
            const x = (e.clientX / window.innerWidth) * 100;
            const y = (e.clientY / window.innerHeight) * 100;
            document.querySelector(".index").style.backgroundPosition = `${x}% ${y}%, ${100 - x}% ${100 - y}%`;
        });
    </script>

@endsection




