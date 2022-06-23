<?php

Route::get('/', 'ShiftController@index');
Route::get('/user', 'ShiftController@user');
Route::get('/user/new', 'ShiftController@user_new');
Route::get('/user/edit/{user}', 'ShiftController@user_edit');
Route::get('/user/search', 'ShiftController@user_search');
Route::get('/make', 'ShiftController@make');
Route::get('/create', 'ShiftController@create');
Route::get('/create/delete', 'ShiftController@create_');
Route::get('/finish/{shift}', 'ShiftController@finish');
Route::post('/create/shift', 'ShiftController@shift_store');
Route::put('/user/edit/update/{user}', 'ShiftController@user_update');
Route::delete('/user/{user}', 'ShiftController@user_delete');