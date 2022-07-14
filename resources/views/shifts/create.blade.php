@extends('layouts.app')

@section('content')
        <form action='/create/shift/check' method='GET'>
            @csrf
            <div class="name">
                <h4>名前</h4>
                <input type="text" name="shift[name]"/>
            </div>
            <div class="date">
                <h4>募集日</h4>
                <input type="date" name="shift[start_date]">
                <p style="display:inline">~</p>
                <input type="date" name="shift[end_date]">
            </div>
            <div class="time">
                <h4>時間指定</h4>
                <p>平日</p>
                <time-component name="shift[weekday_start_time]"></time-component>
                <p style="display:inline">~</p>
                <time-component name="shift[weekday_end_time]"></time-component>
                <p>休日</p>
                <time-component name="shift[holiday_start_time]"></time-component>
                <p style="display:inline">~</p>
                <time-component name="shift[holiday_end_time]"></time-component>
            </div>

            <input type="submit" value="確認"/>
        </form>
        <div class="back"><a href="/make">戻る</a></div>

@endsection