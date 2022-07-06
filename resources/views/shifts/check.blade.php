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
        <div class="datetime">
        <form action="/create/shift" method="POST">
            @csrf
            <input type="hidden" name="shift[name]" value="{{$name}}"/>
            <div class="table">
            <table border="1">
                <tr>
                    <th>日付</th>
                    <th>曜日</th>
                    <th>募集開始時間</th>
                    <th>募集修了時間</th>
                </tr>
            @foreach($dates as $key=>$value)
                <tr>
                    <td>　{{$value['date']}}　</td>
                    <td>　{{$youbi[$key]}}　</td>
                    <input type="hidden" name="shift[{{$key}}_date]" value="{{$value['date']}}"/>
                    <td><input type="text" class="timepicker" name="shift[{{$key}}_start_time]" value="{{$value['start_time']}}" data-time-format="H:i"></td>
                    <td><input type="text" class="timepicker" name="shift[{{$key}}_end_time]" value="{{$value['end_time']}}" data-time-format="H:i"></td>
                </tr>
            @endforeach
            </table>
            </div>
            <script>
                $('.timepicker').timepicker({
                    step:30
                });
            </script>
            <input type="submit" value="確定"/>
        </form>
        </div>
        <div class="back"><a href="/create">戻る</a></div>
    </body>
</html>