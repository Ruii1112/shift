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
        <h2>メンバー新規作成</h2>
        <form action="/user/new_member" method="POST">
            @csrf
            <div class="name">
                <p>名前</p>
                <input type="text" name="user[first_name]"/>
                <input type="text" name="user[last_name]"/>
                <p>ふりがな</p>
                <input type="text" name="user[first_name_kana]"/>
                <input type="text" name="user[last_name_kana]"/>
            </div>
            <div class="birth">
                <p>生年月日</p>
                <input type="date" name="user[birth]"/>
            </div>
            <div class="sex">
                <p>性別</p>
                <label><input type="radio" name="user[sex]" value="1"/>男</label>
                <label><input type="radio" name="user[sex]" value="0"/>女</label>
            </div>
            <div class="login_info">
                <p>ログインID</p>
                <input type="text" name="user[login_id]"/>
                <p>ログインパスワード</p>
                <input type="text" name="user[password]"/>
            </div>
            <input type="submit" value="登録"/>
        </fprm>
        <div class="back"><a href="/user">戻る</a></div>
    </body>
</html>