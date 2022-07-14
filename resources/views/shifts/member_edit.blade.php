@extends('layouts.app')

@section('content')
        <h2>編集</h2>
        <form action="/user/edit/update/{{ $user->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="name">
                <p>名前</p>
                <input type="text" name="user[first_name]" value="{{$user->first_name}}"/>
                <input type="text" name="user[last_name]" value="{{$user->last_name}}"/>
                <p>ふりがな</p>
                <input type="text" name="user[first_name_kana]" value="{{$user->first_name_kana}}"/>
                <input type="text" name="user[last_name_kana]" value="{{$user->last_name_kana}}"/>
            </div>
            <div class="birth">
                <p>生年月日</p>
                <input type="date" name="user[birth]" value="{{$user->birth}}"/>
            </div>
            <div class="sex">
                <p>性別</p>
                <label><input type="radio" name="user[sex]" value="男" @if (old('user[sex]', $user->sex) == '男') checked @endif/>男</label>
                <label><input type="radio" name="user[sex]" value="女" @if (old('user[sex]', $user->sex) == '女') checked @endif/>女</label>
            </div>
            <input type="submit" value="更新"/>
        </fprm>
        <div class="back"><a href="/user">戻る</a></div>

@endsection