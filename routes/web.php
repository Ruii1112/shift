<?php


Route::group(['middleware' => ['auth']], function(){
    Route::get('/distinct', 'ShiftController@distinct');
    Route::get('/', 'ShiftController@index');
    Route::get('/user/index','ShiftController@user_index');
    Route::get('/user', 'ShiftController@user');
    Route::get('/user/shift/past/{shift}', 'ShiftController@user_check');
    Route::get('/user/shift/{shift}', 'ShiftController@user_shift');
    Route::get('/user/new', 'ShiftController@user_new');
    Route::get('/user/edit/{user}', 'ShiftController@user_edit');
    Route::get('/user/search', 'ShiftController@user_search');
    Route::get('/make', 'ShiftController@make');
    Route::get('/create', 'ShiftController@create');
    Route::get('/create/shift/check', 'ShiftController@shift_check');
    Route::post('/user/new_member', 'ShiftController@user_store');
    Route::post('/user/shift/submit', 'ShiftController@usertime_store');
    Route::get('/finish/{shift}', 'ShiftController@finish');
    Route::post('/create/shift', 'ShiftController@shift_store');
    Route::put('/user/edit/update/{user}', 'ShiftController@user_update');
    Route::delete('/user/{user}', 'ShiftController@user_delete');
    Route::get('/output', 'ShiftController@output');
    Route::get('/output/{shift}', 'ShiftController@output_table');
    Route::get('/sheet/{shift}', 'SpreadSheetController@store');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
