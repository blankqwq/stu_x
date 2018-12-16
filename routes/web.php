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

Route::get('/home', 'HomeController@home')->name('stu.home');

Route::get('/', 'HomeController@index')->name('stu.index');



//登录的路由
Route::group(['middleware' => 'auth','namespace'=>'Stu'], function () {
    Route::post('editor_upload', 'FunctionController@upload');


    Route::get('users/search', 'UserController@searchindex')->name('users.search');
    Route::get('users/{user}/small', 'UserController@small')->name('users.small');
    Route::post('users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController',['only'=>['index','show','edit','update']]);

    Route::get('topics/create','TopicController@create')->name('topics.create');

    Route::post('classes/{id}/topics','TopicController@store')->name('topics.store');
    Route::get('topics/{topics}','TopicController@show')->name('topics.show');
    Route::get('topics/{topics}/edit','TopicController@edit')->name('topics.edit');
    Route::put('topics/{topic}','TopicController@update')->name('topics.update');
    Route::delete('topics','TopicController@destroy')->name('topics.destroy');



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
    Route::delete('classuser/{class}','ClassUserController@destroy')->name('classuser.destroy');





    Route::get('classes/{id}/file/{file}', 'ClassesFileController@show')->name('classes.file.show');
    //创建
    Route::post('classes/{id}/filesystem/folder/{file}','ClassesFileController@storefolder')->name('classes.file.storefolder');
    Route::post('classes/{id}/filesystem/file/{file}','ClassesFileController@storefile')->name('classes.file.storefile');
    //删除
    Route::delete('classes/{id}/filesystem/del','ClassesFileController@destroy')->name('classes.file.destroy');


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


    Route::post('replies','ReplyController@store')->name('replies.store');
    Route::delete('replies/{replies}','ReplyController@destroy')->name('replies.destroy');


    Route::get('messages','MessageController@index')->name('messages.index');
    Route::get('messages/{id}','MessageController@ignore')->name('messages.ignore');
    Route::post('messages','MessageController@store')->name('messages.store');

    Route::resource('files', 'FileController',['only'=>['index','show','create','store','edit','update']]);


    Route::delete('files/del','FileController@destroy');
    Route::post('files/new/folder/{id}','FileController@storefolder');
    Route::post('files/update/file/{id}','FileController@storefile');
    Route::get('classfile','FileController@classfile')->name('classfile.index');



    //动态获取一些信息
    Route::get('message/pm', 'MessageController@getpm')->name('messages.pm');
    //动态获取班级中的需求什么的，自动获取追后一个
    Route::get('message/reply', 'MessageController@getreply')->name('messages.reply');
    //动态获取申请的信息，
    Route::get('message/request', 'MessageController@getrequest')->name('messages.request');



    Route::post('permissions/{class}/{id}', 'PermissionsController@giveclass')->name('pers.give');
    Route::delete('permissions/{class}/{id}', 'PermissionsController@delclass')->name('pers.del');


});