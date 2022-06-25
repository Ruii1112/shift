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
                <input type="time" name="shift[weekday_start_time]" step="1800">
                <p style="display:inline">~</p>
                <input type="time" name="shift[weekday_end_time]" step="1800">
                <p>休日</p>
                <input type="time" name="shift[holiday_start_time]" step="1800">
                <p style="display:inline">~</p>
                <input type="time" name="shift[holiday_end_time]" step="1800">
            </div>
            <input type="submit" value="確認"/>
        </form>
        <div class="back"><a href="/make">戻る</a></div>
    </body>
</html>
