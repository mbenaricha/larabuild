<?php

use Illuminate\Support\Facades\Route;

Route::get('/constants', 'HomeController@constantViewer')->name('home.constant-viewer');
Route::get('/vars', 'HomeController@varViewer')->name('home.var-viewer');
