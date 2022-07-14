@extends('layouts.app')

@section('content')
        <div class="output">
            <h2>{{$shift->name}}</h2>
            <table border="1">
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
        <div class="back"><p><a href="/">戻る</a></p></div>

@endsection