<?php

$s = 'dropzoner.';
Route::post('dropzoner/upload', ['as' => $s . 'upload', 'uses' => 'DropzonerController@postUpload']);
Route::post('dropzoner/delete', ['as' => $s . 'delete', 'uses' => 'DropzonerController@postDelete']);