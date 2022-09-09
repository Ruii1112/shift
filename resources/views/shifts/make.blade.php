@extends('layouts.app')

@section('content')
        <p>・<a href='/create'>新規作成</a><p>
        <p>・現在稼働中</p>
        <table border="1">
        @foreach ($shifts as $shift)
            <tr>
                <th>　{{$shift->name}}　</th>
                <th><a href="/finish/{{$shift->id}}"><button>　終了　</button></a></th>
            </tr>
        @endforeach
        </table>
        <br>
        <div class="back"><a href="/">戻る</a></div>
@endsection