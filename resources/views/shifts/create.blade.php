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
        <form action='/create/shift/check' method='GET'>
            @csrf
            <div class="name">
                <h3>名前</h3>
                <input type="text" name="shift[name]"/>
            </div>
            <div class="date">
                <h3>募集日</h3>
                <input type="date" name="shift[start_date]">
                <p style="display:inline">~</p>
                <input type="date" name="shift[end_date]">
            </div>
            <div class="time">
                <h3>時間指定</h3>
                <p>平日</p>
                <input type="text" class="timepicker" name="shift[weekday_start_time]" data-time-format="H:i"/>
                <p style="display:inline">~</p>
                <input type="text" class="timepicker" name="shift[weekday_end_time]" data-time-format="H:i"/>
                <p>休日</p>
                <input type="text" class="timepicker" name="shift[holiday_start_time]" data-time-format="H:i"/>
                <p style="display:inline">~</p>
                <input type="text" class="timepicker" name="shift[holiday_end_time]" data-time-format="H:i"/>
            </div>
            <script>
                $('.timepicker').timepicker({
                    step:30
                });
            </script>
            <input type="submit" value="確認"/>
        </form>
        <div class="back"><a href="/make">戻る</a></div>
    </body>
</html>
