@extends('layouts.app')

@section('content')
        <div class="shift">
            <p>シフト希望出力<p>
            @foreach($shifts as $shift)
                <p>・<a href="/output/{{$shift->id}}">{{$shift->name}}</a></p>
            @endforeach
        </div>
        <div class="back"><p><a href="/">戻る</a></p></div>

@endsection