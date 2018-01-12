<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/1/11
 * Time: 16:59
 */

//首页
Route::get('index','IndexController@index');
//用户评论
Route::post('comment/{id}','CommentController@comment');
//具体视频文章的评论
Route::get('comment_info/{id}', 'CommentController@info');
//点赞
Route::get('comment_like/{id}', 'CommentController@like');
//集体文章下评论数
Route::get('comment_count/{id}', 'CommentController@count');