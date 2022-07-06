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
        <h2>シフト希望</h2>
        <form action="/user/shift/submit" method="POST">
            @csrf
            <div class="name_select">
            <h3>名前</h3>
            <select name="time[user_id]">
                @foreach($users as $user)
                    <option value={{ $user->id }}>{{$user->first_name}} {{$user->last_name}}</option>
                @endforeach
            </select>
            </div>
            <div class="shift">
            <h3>希望</h3>
                <input type="hidden" name="time[shift_id]" value="{{$shift}}"/>
            <table border="1">
                <tr>
                    <th>　日時　</th>
                    <th>　曜日　</th>
                    <th>　募集時間　</th>
                    <th>　希望開始時間　</th>
                    <th>　希望終了時間　</th>
                <tr>
            @foreach($times as $key=>$value)
                <tr>
                    <td>　{{$value['date']}}　</td>
                    <td>　{{$youbi[$key]}}　</td>
                    <td>　{{$value['start_time']}} ~ {{$value['end_time']}}　</td>
                    <input type="hidden" name="time[{{$key}}_date]" value="{{$value['date']}}"/>
                    <td><input type="time" name="time[{{$key}}_start_time]" min="{{$value['start_time']}}" max="{{$value['end_time']}}"></td>
                    <td><input type="time" name="time[{{$key}}_end_time]" min="{{$value['start_time']}}" max="{{$value['end_time']}}"></td>
                </tr>
            @endforeach
            </table>
            <h3>コメント</h3>
                <textarea name="time[comment]"></textarea>
            </div>
            <p></p>
            <input type="submit" value="提出"/>
        </form>
        <div><p><a href="/user/index">戻る<a></div>
    </body>
</html>
