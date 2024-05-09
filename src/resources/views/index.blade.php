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
<div class="attendance__alert">
  // メッセージ機能
</div>
{{ $users->links() }}
<div class="attendance__content">
  <div class="attendance__panel">
    <form class="attendance__button">
      <button class="attendance__button-submit" type="submit">勤務開始</button>
    </form>
    <form class="attendance__button">
      <button class="attendance__button-submit" type="submit">勤務終了</button>
    </form>
  </div>
  <div class="attendance-table">
    <table class="attendance-table__inner">
      <tr class="attendance-table__row">
        <th class="attendance-table__header">名前</th>
        <th class="attendance-table__header">開始時間</th>
        <th class="attendance-table__header">終了時間</th>
      </tr>
      <tr class="attendance-table__row">
        <td class="attendance-table__item">サンプル太郎</td>
        <td class="attendance-table__item">サンプル</td>
        <td class="attendance-table__item">サンプル</td>
      </tr>
    </table>
  </div>
</div>
@endsection
