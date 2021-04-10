<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test2Controller;
use App\Http\Controllers\InvoicesController;

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

Route::get('/template', function () {
    return view('index');
});

Route::get('/faktury', [InvoicesController::class, 'index'])->name('invoices.index');

Route::get('/faktury/dodaj', [InvoicesController::class, 'create'])->name('invoices.create');
Route::get('/faktury/edytuj/{id}', [InvoicesController::class, 'edit'])->name('invoices.edit');
Route::post('/faktury/zapisz', [InvoicesController::class, 'store'])->name('invoices.store');
Route::put('/faktury/zmien/{id}', [InvoicesController::class, 'update'])->name('invoices.update');
Route::put('/faktury/zmien/{id}', [InvoicesController::class, 'update'])->name('invoices.update');
Route::delete('/faktury/usun/{id}', [InvoicesController::class, 'delete'])->name('invoices.delete');


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

Route::resource('student', 'StudentController');

Route::get('ajaxdata', 'AjaxdataController@index')->name('ajaxdata');
Route::get('ajaxdata/getdata', 'AjaxdataController@getdata')->name('ajaxdata.getdata');

Route::post('ajaxdata/postdata', 'AjaxdataController@postdata')->name('ajaxdata.postdata');

Route::get('/search', 'SearchController@index');
