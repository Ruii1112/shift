@extends('layouts.app')

@section('content')
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
                <label><input type="radio" name="user[sex]" value="男"/>男</label>
                <label><input type="radio" name="user[sex]" value="女"/>女</label>
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

@endsection