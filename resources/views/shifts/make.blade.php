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
        <p>・<a href='/create'>新規作成</a><p>
        <p>・現在稼働中</p>
        @foreach ($shifts as $shift)
            <table border="1">
                <tr>
                    <th>　{{$shift->name}}　</th>
                    <th><a href="/finish/{{$shift->id}}"><button>　終了　</button></a></th>
                </tr>
            </table>
        @endforeach
        <div class="back"><a href="/">戻る</a></div>
    </body>
</html>
