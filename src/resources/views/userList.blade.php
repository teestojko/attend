@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userList.css') }}">
@endsection

@section('content')
    <div class="main">
        <div class="content">
            <h2>
                ユーザー一覧
            </h2>
            <table class="list-table">
                <tr class="list-low">
                    <th>
                        ID
                    </th>
                    <th>
                        名前
                    </th>
                    <th>
                    </th>
                </tr>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="list-user">
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                <a href="{{ route('user.attendance', ['user' => $user->id]) }}" class="button">
                                    詳細
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($users->count() > 0)
                {{ $users->links() }}
            @else
                <p>出勤データがありません。</p>
            @endif
        </div>
    </div>
@endsection
