@extends('layouts.app')

@section('content')
        <h2>シフト希望</h2>
        <div class="form">
            <form action="/user/shift/submit" method="POST">
            @csrf
                <reflection-component :times="{{ json_encode($times)}}" :youbi_shift="{{ json_encode($youbi) }}"></reflection-component>
                <h3>コメント</h3>
                    <textarea name="time[comment]" cols="80" rows="10"></textarea>
                <br>
                <input type="hidden" name="time[shift_id]" value="{{$shift}}"/>
                <input type="submit" value="提出"/>
            </form>
        </div>
        <div><p><a href="/user/index">戻る</a></div>
        
@endsection