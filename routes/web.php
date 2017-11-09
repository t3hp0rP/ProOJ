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

//Route::any('/test','QuizController@addQuiz');

Route::get('/admin/login','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login','Admin\LoginController@login')->name('admin.login.submit');
Route::get('/admin','Admin\IndexController@index')->name('admin.dashboard');
Route::post('/admin/logout','Admin\LoginController@logout')->name('admin.logout');

Route::post('/admin/uploadQuizFile/{id?}','Admin\QuizController@uploadQuizFile');
Route::get('/admin/removeQuizFile/{id?}','Admin\QuizController@removeQuizFile');
Route::post('/admin/createQuiz','Admin\QuizController@createQuiz')->name('admin.createQuiz');
Route::any('/admin/changeQuiz/{id}','Admin\QuizController@changeQuiz')->name('admin.changeQuiz');
Route::get('/admin/delQuiz/{id}','Admin\QuizController@delQuiz')->name('admin.delQuiz');