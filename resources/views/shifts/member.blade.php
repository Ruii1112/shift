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
        <div class="search">
            <h3>検索</h3>
            <form action="/user/search" method="GET">
                <table border="1">
                    <tr>
                        <th>　名前　</th>
                        <th><input type="text" name="first_name" value="{{ $first_name }}"/></th>
                        <th><input type="text" name="last_name" value="{{ $last_name }}"/></th>
                    </tr>
                </table>
                <input type="submit" value="検索"/>
                <button><a href='/user'>クリア</a></button>
            </form>
        </div>
        <div class="user">
            <table border="1">
                <tr>
                    <th>　名前　</th>
                    <th>　名前かな　</th>
                    <th>　生年月日　</th>
                    <th>　性別　</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <th>　{{$user->first_name}} {{$user->last_name}}　</th>
                        <th>　{{$user->first_name_kana}} {{$user->last_name_kana}}　</th>
                        <th> {{ $user->birth }}</th>
                        <th> {{$user->sex}}</th>
                        <th><a href="/user/edit/{{$user->id}}" style="text-decoration:none">　編集　</a></th>
                        <th>
                            <form action="/user/{{ $user->id }}" id="form_{{ $user->id }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit">削除</button> 
                            </form>
                        </th>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="register"><p><a href="/user/new">新規登録</a></p></div>
        <div class="back"><a href="/">戻る</a></div>
    </body>
</html>
