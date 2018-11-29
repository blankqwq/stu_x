<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('stu.home');

//登录的路由
Route::group(['middleware' => 'auth','namespace'=>'Stu'], function () {
//    Route::post('editor_upload', 'FunctionController@upload');
    Route::get('users/search', 'UserController@searchindex')->name('users.search');
    Route::get('users/{user}/small', 'UserController@small')->name('users.small');
    Route::post('users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController',['only'=>['index','show','edit','update']]);


    Route::post('classes/{id}/topics','TopicController@store')->name('topics.store');
    Route::get('topics/{topics}','TopicController@show')->name('topics.show');
    Route::get('topics/{topics}/edit','TopicController@edit')->name('topics.edit');
    Route::put('topics/{topics}','TopicController@update')->name('topics.update');


    Route::post('classes/{id}/homework','HomeworkController@store')->name('homework.store');
    Route::get('homework/{id}','HomeworkController@show')->name('homework.show');
    Route::get('homework/{id}/edit','HomeworkController@edit')->name('homework.edit');
    Route::put('homework/{id}','HomeworkController@update')->name('homework.update');
    Route::get('homework/{id}/correct','HomeworkController@correct')->name('homework.correct');


    Route::get('stuhomework/{id}','StuHomeworkController@show')->name('stuhomework.show');
    Route::put('stuhomework/{id}','StuHomeworkController@update')->name('stuhomework.update');
    Route::post('stuhomework/{id}','StuHomeworkController@store')->name('stuhomework.store');


    Route::get('classuser','ClassUserController@index')->name('classuser.index');
    Route::post('classuser/{id}/agree/{message?}','ClassUserController@agree')->name('classuser.agree');
    Route::post('classuser/{id}/disagree/{message?}','ClassUserController@disagree')->name('classuser.disagree');


    Route::post('classes/{id}/join','ClassUserController@store')->name('classuser.store');
    Route::get('classes/{id}/join','ClassUserController@create')->name('classes.joining');
    Route::get('classes/verify','ClassController@verify')->name('classes.verify');
    Route::get('classes/agree','ClassController@getagree')->name('classes.getagree');
    Route::get('classes/disagree','ClassController@getdisagree')->name('classes.getdisagree');

    Route::post('classes/agree/{id}/{message?}','ClassController@agree')->name('agree.classes');
    Route::post('classes/disagree/{id}/{message?}','ClassController@disagree')->name('disagree.classes');


    Route::get('classes/me','ClassController@me')->name('classes.join');
    Route::get('classes/my','ClassController@my')->name('classes.my');
    Route::get('classes/{id}/small', 'ClassController@smallshow')->name('classes.small');
    Route::resource('classes', 'ClassController',['only'=>['index','show','create','store','edit','update']]);
    Route::get('classes/{id}/users', 'ClassController@users')->name('classes.users');


    Route::post('reply','ReplyController@store')->name('reply.store');
    //是否是班级中的人！权限（中间件）
//    Route::resource('homework', 'HomeworkController',['only'=>['show','create','edit','update']]);

    Route::get('messages','MessageController@index')->name('messages.index');
    Route::get('messages/{id}','MessageController@ignore')->name('messages.ignore');


    Route::resource('flies', 'FileController',['only'=>['index','show','create','store','edit','update']]);

});