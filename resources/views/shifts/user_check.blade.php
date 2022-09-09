@extends('layouts.app')

@section('content')
        <div class="check">
            <div class="user_name">
                <p>{{Auth::user()->first_name}}さんの{{$shift->name}}の提出内容確認</p>
            </div>
            <div class='shift'>
                <table border="1" class="table">
                    <tr>
                        <th>日付</th>
                        <th>曜日</th>
                        <th>希望開始時間</th>
                        <th>希望終了時間</th>
                    </tr>
                    @foreach($times as $time)
                        <tr>
                            <td>{{$time['date']}}</td>
                            <td>{{$time['youbi']}}</td>
                            <td>{{$time['start_time']}}</td>
                            <td>{{$time['end_time']}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <br>
            <div class="comment">
                <h3>コメント</h3>
                <p>{{$comment}}</p>
            </div>
        </div>
        <div class="back"><p><a href="/user/index">戻る</a></p>

@endsection