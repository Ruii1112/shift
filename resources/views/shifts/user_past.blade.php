@extends('layouts.app')

@section('content')
        <div class='name_select'>
            <form action="/user/past/{{$shifts->id}}" method="GET">
                @csrf
                <div class="button"><input type="submit" value="選択"/></div>
            </form>
        </div>
        <div class="back"><p><a href="/user/index">戻る</a></p>

@endsection