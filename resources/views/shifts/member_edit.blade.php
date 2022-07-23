@extends('layouts.app')

@section('content')
        <h2>編集</h2>
        <form action="/user/edit/update/{{ $user->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="name">
                <p>名前</p>
                <p class="first_name__error" style="color:red">{{ $errors->first('user.first_name') }}</p>
                <p class="last_name__error" style="color:red">{{ $errors->first('user.last_name') }}</p>
                <input type="text" name="user[first_name]" value="{{ old('user.first_name', $user->first_name) }}"/>
                <input type="text" name="user[last_name]" value="{{ old('user.last_name', $user->last_name) }}"/>
                <p>ふりがな</p>
                <p class="first_name_kana__error" style="color:red">{{ $errors->first('user.first_name_kana') }}</p>
                <p class="last_name_kana__error" style="color:red">{{ $errors->first('user.last_name_kana') }}</p>
                <input type="text" name="user[first_name_kana]" value="{{ old('user.first_name_kana', $user->first_name_kana) }}"/>
                <input type="text" name="user[last_name_kana]" value="{{ old('user.last_name_kana', $user->last_name_kana) }}"/>
            </div>
            <div class="birth">
                <p>生年月日</p>
                <input type="date" name="user[birth]" value="{{ old('user.birth', $user->birth) }}"/>
                <p class="birth__error" style="color:red">{{ $errors->first('user.birth') }}</p>
            </div>
            <div class="sex">
                <p>性別</p>
                <label><input type="radio" name="user[sex]" value="男" @if (old('user.sex', $user->sex) == '男') checked @endif/>男</label>
                <label><input type="radio" name="user[sex]" value="女" @if (old('user.sex', $user->sex) == '女') checked @endif/>女</label>
                <p class="sex__error" style="color:red">{{ $errors->first('user.sex') }}</p>
            </div>
            <input type="submit" value="更新"/>
        </fprm>
        <div class="back"><a href="/user">戻る</a></div>

@endsection