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
        <div class="shift_operation">
            <p>現在稼働中</p>
            @foreach($shifts_operation as $shift)
                <p>・<a href="/user/shift/{{$shift->id}}">{{$shift->name}}</a></p>
            @endforeach
        </div>
        <div class="shift_past">
            <p>過去シフト希望<p>
            @foreach($shifts_past as $shift)
                <p>・<a href="/user/shift/past/{{$shift->id}}">{{$shift->name}}</a></p>
            @endforeach
        </div>
    </body>
</html>
