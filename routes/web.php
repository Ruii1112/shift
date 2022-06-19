<?php

Route::get('/', 'ShiftController@index');
Route::get('/user', 'ShiftController@user');
Route::get('/user/new', 'ShiftController@user_new');
Route::post('/user/new_member', 'ShiftController@user_store');
Route::get('/user/edit/{user}', 'ShiftController@user_edit');
Route::put('/user/edit/update/{user}', 'ShiftController@user_update');
Route::delete('/user/{user}', 'ShiftController@user_delete');