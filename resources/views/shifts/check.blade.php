<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <!-- jQuery-datetimepicker -->
        <script src="https://cdn.rawgit.com/jonthornton/jquery-timepicker/3e0b283a/jquery.timepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdn.rawgit.com/jonthornton/jquery-timepicker/3e0b283a/jquery.timepicker.min.css">    
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
                    <td>　{{$value['date']}}　</td>
                    <input type="hidden" name="shift[{{$key}}_date]" value="{{$value['date']}}"/>
                    <td><input type="time" name="shift[{{$key}}_start_time]" value="{{$value['start_time']}}"></td>
                    <td><input type="time" name="shift[{{$key}}_end_time]" value="{{$value['end_time']}}"></td>
                </tr>
            @endforeach
            </table>
            <input type="submit" value="確定"/>
        </form>
        <div class="back"><a href="/create">戻る</a></div>
    </body>
</html>