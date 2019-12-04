<?php

Route::get('dashboard', function () {
    return redirect()->route('admin.dashboard');
});

Route::namespace('Admin')->prefix('admin')->as('admin.')->group(function() {
    Route::get('dashboard', 'AdministrationController@dashboard')->name('dashboard');

    Route::patch('artist/{id}', 'ArtistsController@active_artist')->name('artists.active');
    Route::resource('artists', 'ArtistsController');

    Route::patch('album/{id}', 'AlbumsController@active_album')->name('albums.active');
    Route::resource('albums', 'AlbumsController');

    Route::patch('single/{id}', 'SinglesController@active_single')->name('singles.active');
    Route::resource('singles', 'SinglesController');

    Route::patch('active-user/{id}', 'UsersController@active_user')->name('users.active');
    Route::resource('users', 'UsersController');
});
