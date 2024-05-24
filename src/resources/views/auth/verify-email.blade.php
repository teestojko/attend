@extends('layouts.app')

@section('content')
<div>
    <h1>Email Verification</h1>
    <p>Before proceeding, please check your email for a verification link.</p>
    <p>If you did not receive the email, <a href="{{ route('verification.send') }}">click here to request another</a>.</p>

    @if (session('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif
</div>
@endsection
