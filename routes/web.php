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
    return view('welcome');
});

Auth::routes();

Route::get('/captcha/{rand}','CaptchaController@getCaptcha');

Route::get('/rank','HomeController@getRank');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/part/{part}','HomeController@enterPart');
Route::get('/user','UserController@index')->name('user');
Route::any('/change','UserController@change');

Route::get('/activation/{uid}/{activeCode}','Auth\ActivateController@activateUser');
Route::get('/resendMail/{uid}','Auth\ActivateController@resendMail');

Route::post('/flag','FlagController@index');