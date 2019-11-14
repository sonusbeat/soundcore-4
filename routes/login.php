<?php

Route::namespace('Auth')->prefix('admin')->group(function() {
    Route::get('login', 'LoginController@showLoginForm')->name('admin.show-login');
    Route::post('login', 'LoginController@login')->name('admin.attempt-login');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');
});
