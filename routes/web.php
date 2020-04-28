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

use App\Http\Controllers\CategoryController;
use App\Database\CategoryRepository;
use App\Database\DBCategoryRepository;

Route::get('/', function () {
    if(Auth::check()){
        return redirect('/login'); 
    }
});

Route::get('/test/{name}', "TestController@run");
Route::resources([
    "category" => 'CategoryController',
    "page" => 'PageController'
]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
