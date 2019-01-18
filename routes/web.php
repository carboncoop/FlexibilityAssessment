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

Route::get('/', function () {
    return view('home');
});

Route::get('/more-about-the-project', function () {
    return view('more-about-the-project');
});

Route::get('/how-could-I-benefit-from-flexibility', function () {
    return view('how-could-I-benefit-from-flexibility');
});

Route::get('/how-could-my-organisation-benefit-from-flexibility', function () {
    return view('how-could-my-organisation-benefit-from-flexibility');
});

Route::get('/scotland-potential-flexibility-map', function () {
    return view('scotland-potential-flexibility-map');
});

Route::resource('assessment', 'AssessmentController')->only(['index','edit']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
