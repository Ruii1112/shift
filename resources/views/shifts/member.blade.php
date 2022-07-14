@extends('layouts.app')

@section('content')
        <div class="search">
            <h3>検索</h3>
            <form action="/user/search" method="GET">
                <table border="1">
                    <tr>
                        <th>　名前 or 名前かな　</th>
                        <th><input type="text" name="first_name" value="{{ $first_name }}"/></th>
                        <th><input type="text" name="last_name" value="{{ $last_name }}"/></th>
                    </tr>
                </table>
                <input type="submit" value="検索"/>
                <button><a href='/user'>クリア</a></button>
            </form>
        </div>
        <div class="user">
            <table border="1">
                <tr>
                    <th>　名前　</th>
                    <th>　名前かな　</th>
                    <th>　生年月日　</th>
                    <th>　性別　</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>　{{$user->first_name}} {{$user->last_name}}　</td>
                        <td>　{{$user->first_name_kana}} {{$user->last_name_kana}}　</td>
                        <td> {{ $user->birth }}</td>
                        <td> {{$user->sex}}</td>
                        <td><a href="/user/edit/{{$user->id}}" style="text-decoration:none">　編集　</a></td>
                        <td>
                            <form action="/user/{{ $user->id }}" id="form_{{ $user->id }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit">削除</button> 
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="register"><p><a href="/user/new">新規登録</a></p></div>
        <div class="back"><a href="/">戻る</a></div>

@endsection