<?php

Route::group(['prefix' => 'api'], function () {
    //登录
    Route::post('login/login', '\Yangyifan\Administrator\Login\Controller\LoginController@login');
});


