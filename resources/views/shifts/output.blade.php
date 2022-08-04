@extends('layouts.app')

@section('content')
        <div class="shift">
            <p>シフト希望出力<p>
            <ul>
            @foreach($shifts as $shift)
                <li><a href="/output/{{$shift->id}}">{{$shift->name}}</a></li>
            @endforeach
            </ul>
        </div>
        <div class="back"><p><a href="/">戻る</a></p></div>

@endsection