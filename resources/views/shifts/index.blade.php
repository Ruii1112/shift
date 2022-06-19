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
        <div class="selection">
            <p><a href="/make">・シフト希望作成</a></p>
            <p><a href="/output">・シフト希望出力</a></p>
            <p><a href="/user">・メンバー編集</a></p>
        </div>
    </body>
</html>