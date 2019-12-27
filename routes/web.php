<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/',
//    function () {
//        return view('welcome');
//    });

//Route::get('/custids', 'InfosController@custids');

// ------------------------------------------------------------------------------- latest version  with POO

Route::get('/',
    function () {
        return view('home');
    });

Route::get('/home',
    function () {
        return view('home');
    });

Route::get('/consts', function () {
    return view('consts');       // POO
});

Route::get('/vars', function () {
    return view('vars');       // POO
});

Route::get('/all', 'InfosController@all');  // return app object (CustomApps class)


Route::get('/tt', 'InfosController@tt');  // return app object (CustomApps class)


