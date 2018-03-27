<?php
/**
 * Created by PhpStorm.
 * User: huangangui
 * Date: 2018/3/26
 * Time: 下午1:12
 */

Route::get('phpno1-notice', 'BugsLife\QueryNotice\Format\Database\NoticeController@index');
Route::post('phpno1-notice', 'BugsLife\QueryNotice\Format\Database\NoticeController@getData');
Route::post('phpno1-notice/update', 'BugsLife\QueryNotice\Format\Database\NoticeController@update');