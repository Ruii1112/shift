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
        <h3>最終調整</h3>
        <form action="/create/shift" method="POST">
            @csrf
            <input type="hidden" name="shift[name]" value="{{$name}}"/>
            <table border="1">
            @foreach($dates as $key=>$value)
                <tr>
                    <th>　{{$value['date']}}　</th>
                    <input type="hidden" name="shift[{{$key}}_date]" value="{{$value['date']}}"/>
                    <th><input type="time" name="shift[{{$key}}_start_time]" value="{{$value['start_time']}}" step="1800"></th>
                    <th><input type="time" name="shift[{{$key}}_end_time]" value="{{$value['end_time']}}" step="1800"></th>
                </tr>
            @endforeach
            </table>
            <input type="submit" value="確定"/>
        </form>
        <div class="back"><a href="/create">戻る</a></div>
    </body>
</html>