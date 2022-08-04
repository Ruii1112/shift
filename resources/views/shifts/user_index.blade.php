@extends('layouts.app')

@section('content')

        <div class="shift_operation">
            <p>現在稼働中</p>
            @foreach($shifts_operation as $shift)
                <p>・<a href="/user/shift/{{$shift->id}}">{{$shift->name}}</a></p>
            @endforeach
        </div>
        <div class="shift_past">
            <p>過去シフト希望<p>
            <ul>
            @foreach($shifts_past as $shift)
                <li><a href="/user/shift/past/{{$shift->id}}">{{$shift->name}}</a></li>
            @endforeach
            </ul>
        </div>

@endsection