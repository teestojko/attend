<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>
                Atte
            </title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
    </head>
    <body>
        <div class="verify_content">
            <h1>
                メール受信確認
            </h1>
            <p>
                先のページに進む前に、メールの受信確認をしてください。
            </p>
            <p>
                メールを受信していない方は下記のリンクで再送信をお願いします。
                    <form method="POST" action="{{ route('verification.send') }}" style="display:inline;">
                    @csrf
                        <button type="submit">
                            メールの再送信
                        </button>
                    </form>
            </p>
            @if (session('message'))
                <div>
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </body>
</html>
