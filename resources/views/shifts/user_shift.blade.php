@extends('layouts.app')

@section('content')
        <h3>シフト希望</h3>
        <div class="form">
            <form action="/user/shift/submit" method="POST">
            @csrf
                <reflection-component :times="{{ json_encode($times)}}" :youbi_shift="{{ json_encode($youbi) }}"></reflection-component>
                <br>
                <h4>コメント</h4>
                    <textarea name="time[comment]" cols="50" rows="5"></textarea>
                <br>
                <input type="hidden" name="time[shift_id]" value="{{$shift}}"/>
                <input type="submit" class="btn btn-primary" value="提出"/>
            </form>
        </div>
        <br>
        <div><p><a href="/user/index">戻る</a></div>
        
@endsection