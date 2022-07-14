@extends('layouts.app')

@section('content')

        <div class='name_select'>
            <form action="/user/past/{{$shifts->id}}" method="GET">
                @csrf
                <div class="select">
                    <h3>名前選択</h3>
                    <select name="name">
                        @foreach($users as $user)
                            <option value={{ $user->id }}>{{$user->first_name}} {{$user->last_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="button"><input type="submit" value="選択"/></div>
            </form>
        </div>
        <div class="back"><p><a href="/user/index">戻る</a></p>

@endsection