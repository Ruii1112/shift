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
        <div class="shift">
            <p>シフト希望出力<p>
            @foreach($shifts as $shift)
                <p>・<a href="/output/{{$shift->id}}">{{$shift->name}}</a></p>
            @endforeach
        </div>
        <div class="back"><p><a href="/">戻る</a></p></div>
    </body>
</html>
