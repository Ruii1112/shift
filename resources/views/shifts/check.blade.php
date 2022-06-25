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
        @foreach($dates as $date)
            <p>{{$date}}</p>
            <p>{{$time['weekday_start_time']}}</p>
            <p>{{$time['weekday_end_time']}}</p>
        @endforeach
        <div class="back"><a href="/make">戻る</a></div>
    </body>
</html>