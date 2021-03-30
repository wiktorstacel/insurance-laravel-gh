<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test2Controller;

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
    return view('welcome2');
});

/*Route::get('/test1', function () {
    return 'Test1';
});

Route::get('/test2', function () {
    return view('test2');
});*/

Route::get('/test2', [App\Http\Controllers\Test2Controller::class, 'show']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/main', 'MainController@index');
Route::post('/main/checklogin', 'MainController@checklogin');
Route::get('main/successlogin', 'MainController@successlogin');
Route::get('main/logout', 'MainController@logout');

Route::get('tabledit', 'TableditController@index');
Route::post('tabledit/action', 'TableditController@action')->name('tabledit.action');
