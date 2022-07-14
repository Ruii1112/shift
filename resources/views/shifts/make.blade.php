@extends('layouts.app')

@section('content')
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
@endsection