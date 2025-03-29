@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userList.css') }}">
@endsection

@section('content')
    <div class="user-list">
        <div class="user-list-content">
            <h2 class="">
                ユーザー一覧
            </h2>
            <table class="user-list-table">
                <tr class="user-list-low">
                    <th class="list-label">
                        ID
                    </th>
                    <th class="list-name-label">
                        名前
                    </th>
                    <th class="list-detail-label">
                    </th>
                </tr>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="list-user">
                            <td class="list-data">
                                {{ $user->id }}
                            </td>
                            <td class="list-data">
                                {{ $user->name }}
                            </td>
                            <td class="list-data">
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
                <p class="empty-message">出勤データがありません。</p>
            @endif
        </div>
    </div>
@endsection
