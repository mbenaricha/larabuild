<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/constants', 'HomeController@constants')->name('home.constants');
Route::get('/variables', 'HomeController@variables')->name('home.variables');
Route::get('/reset-cache', 'HomeController@resetCache')->name('home.reset-cache');
