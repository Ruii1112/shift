<?php

Route::get('/', 'ShiftController@index');
Route::get('/user', 'ShiftController@user');
Route::get('/user/new', 'ShiftController@user_new');
Route::post('/user/new_member', 'ShiftController@user_store');