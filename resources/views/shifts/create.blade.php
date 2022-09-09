@extends('layouts.app')

@section('content')
        <form action='/create/shift/check' method='GET'>
            @csrf
            <div class="name form-group">
                <h4>名前</h4>
                <p class="name__error" style="color:red">{{ $errors->first('shift.name') }}</p>
                <input type="text" name="shift[name]" value="{{ old('shift.name') }}"/>
            </div>
            <div class="date form-group">
                <h4>募集日</h4>
                <p class="start_date__error" style="color:red">{{ $errors->first('shift.start_date') }}</p>
                <p class="end_date__error" style="color:red">{{ $errors->first('shift.end_date') }}</p>
                <input type="date" name="shift[start_date]" value="{{ old('shift.start_date') }}"/>
                <p style="display:inline">~</p>
                <input type="date" name="shift[end_date]" value="{{ old('shift.end_date') }}"/>
            </div>
            <div class="time form-group">
                <h4>時間指定</h4>
                <div class="weekday form-group">
                    <p>平日</p>
                    <p class="weekday_start_time__error" style="color:red">{{ $errors->first('shift.weekday_start_time') }}</p>
                    <p class="weekday_end_time__error" style="color:red">{{ $errors->first('shift.weekday_end_time') }}</p>
                    <time-component name="shift[weekday_start_time]" value="{{ old('shift.weekday_start_time') }}"></time-component>
                    <p style="display:inline">~</p>
                    <time-component name="shift[weekday_end_time]" value="{{ old('shift.weekday_end_time') }}"></time-component>
                </div>
                <div class="weekend form-group">
                    <p>休日</p>
                    <p class="holiday_start_time__error" style="color:red">{{ $errors->first('shift.holiday_start_time') }}</p>
                    <p class="holiday_end_time__error" style="color:red">{{ $errors->first('shift.holiday_end_time') }}</p>
                    <time-component name="shift[holiday_start_time]" value="{{ old('shift.holiday_start_time') }}"></time-component>
                    <p style="display:inline">~</p>
                    <time-component name="shift[holiday_end_time]" value="{{ old('shift.holiday_end_time') }}"></time-component>
                </div>
            </div>

            <input type="submit" class="btn btn-primary" value="確認"/>
        </form>
        <br>
        <div class="back"><a href="/make">戻る</a></div>

@endsection