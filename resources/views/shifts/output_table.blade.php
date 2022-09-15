@extends('layouts.app')

@section('content')
    <div class="output">
        <h2>{{$shift->name}}</h2>
        <br>
        <div class="btns" style="margin-bottom: 1%;">
            <button type="button" class="btn btn-primary" onclick="location.href='/sheet/{{$shift->id}}'">スプレッドシートに反映</button>
            <a href="https://docs.google.com/spreadsheets/d/1oUzVYRxG3lq0ftuF8w7h5VypnSt_19E_wVW5cwyAQGo/edit#gid=0" target="_blank" rel="noopener noreferrer">スプレッドシート</a>
            <p style="color: red;">※スプレッドシートへの反映は少し時間がかかりますので、クリック後は少々お待ちください</p>
        </div>
        <table border="1" class="table">
            <div class="user">
                <tr>
                    <th>日付</th>
                    <th>曜日</th>
                    @foreach($users as $user)
                        <td colspan="2">{{$user->first_name}} {{$user->last_name}}</td>
                    @endforeach
                </tr>
            </div>
            <div class='time'>
                @foreach($indices_date as $index_date)
                    <tr>
                        <td>{{$shifttime[$index_date]->date}}</td>
                        <td>{{$youbi[$index_date]}}</td>
                        @foreach($indices_user as $index_user)
                            <td>{{$user_time[$index_date][$index_user]}}</td>
                        @endforeach
                    </tr>
                @endforeach
            </div>
            <div class="comment">
                <tr>
                    <td colspan="2">コメント</td>
                    @foreach($comments as $comment)
                        <td colspan="2">{{$comment}}</td>
                    @endforeach
                </tr>
            </div>
        </table>
    </div>
    <br>
    <div class="back"><p><a href="/">戻る</a></p></div>

@endsection