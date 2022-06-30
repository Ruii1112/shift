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
        <div class="check">
            <div class="user_name">
                <p>{{$user[0]->first_name}}さんの{{$shift->name}}の提出内容確認</p>
            </div>
            <div class='shift'>
                <table border="1">
                    <tr>
                        <th>日付</th>
                        <th>希望開始時間</th>
                        <th>希望終了時間</th>
                    </tr>
                    @foreach($times as $time)
                        <tr>
                            <th>{{$time['date']}}</th>
                            <th>{{$time['start_time']}}</th>
                            <th>{{$time['end_time']}}</th>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="comment">
                <h3>コメント</h3>
                <p>{{$comment[0]->sentence}}</p>
            </div>
        </div>
        <div class="back"><p><a href="/user/index">戻る</a></p>
    </body>
</html>
