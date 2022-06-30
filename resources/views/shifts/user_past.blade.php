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
        <div class='name_select'>
            <form action="/user/past/{{$shifts->id}}" method="GET">
                @csrf
                <div class="select">
                    <h3>名前選択</h3>
                    <select name="name">
                        @foreach($users as $user)
                            <option value={{ $user->id }}>{{$user->first_name}} {{$user->last_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="button"><input type="submit" value="選択"/></div>
            </form>
        </div>
        <div class="back"><p><a href="/user/index">戻る</a></p>
    </body>
</html>
