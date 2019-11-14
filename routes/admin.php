<?php

Route::namespace('Admin')->prefix('admin')->as('admin.')->group(function() {
    Route::get('dashboard', 'AdministrationController@dashboard')->name('dashboard');

    Route::patch('artist-artist/{id}', 'ArtistsController@active_artist')->name('artists.active');
    Route::resource('artists', 'ArtistsController');

    Route::patch('active-user/{id}', 'UsersController@active_user')->name('users.active');
    Route::resource('users', 'UsersController');
});
