@extends('layouts.app')

@section('content')

        <div class="shift_operation">
            <h4>現在稼働中</h4>
            <ul>
            @foreach($shifts_operation as $shift)
                <li><a href="/user/shift/{{$shift->id}}">{{$shift->name}}</a></li>
            @endforeach
            </ul>
        </div>
        <div class="shift_past">
            <h4>過去シフト希望</h4>
            <ul>
            @foreach($shifts_past as $shift)
                <li><a href="/user/shift/past/{{$shift->id}}">{{$shift->name}}</a></li>
            @endforeach
            </ul>
        </div>

@endsection