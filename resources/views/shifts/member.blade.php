<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Shift Manegiment</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <h1>シフト希望管理システム</h1>
        <p><a href="/user/new">新規登録</a></p>
        <div class="user">
            <table border="1">
                <tr>
                    <th>　名前　</th>
                    <th>　かな　</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <th>　{{$user->first_name}} {{$user->last_name}}　</th>
                        <th>　{{$user->first_name_kana}} {{$user->last_name_kana}}　</th>
                        <th><a href="/user/edit">　編集　</a></th>
                        <th><a href="/user/delete">　削除　</a></th>
                    </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>
