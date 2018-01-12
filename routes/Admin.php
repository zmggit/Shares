<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/1/11
 * Time: 14:00
 */
//登录
Route::post('login', 'AuthController@postLogin');
//上传图片
Route::post('api_upload', 'ApiUploadController@upload');

//获取open_id
Route::get('code','ApiUploadController@code');

Route::group([
   'middleware'=>['auth:api'
]],function (){
  //退出
    Route::get('logout','AuthController@logout');

    //发布的资讯
    Route::post('new', 'NewController@store');
    Route::get('new', 'NewController@index');
    Route::post('new/{id}/delete', 'NewController@destroy');
    Route::post('new/{id}/edit', 'NewController@edit');
    Route::get('new/{id}', 'NewController@info');
//修改状态
    Route::post('new/{id}', 'NewController@status');


});
