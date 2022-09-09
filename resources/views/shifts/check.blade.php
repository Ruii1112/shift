@extends('layouts.app')

@section('content')
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
                            <td><time-component name="shift[{{$key}}_start_time]" value="{{$value['start_time']}}"/></td>
                            <td><time-component name="shift[{{$key}}_end_time]" value="{{$value['end_time']}}"/></td>
                        </tr>
                    @endforeach
                    </table>
                </div>
                <input type="submit" class="btn btn-primary" value="確定"/>
            </form>
        </div>
        <br>
        <div class="back"><a href="/create">戻る</a></div>

@endsection