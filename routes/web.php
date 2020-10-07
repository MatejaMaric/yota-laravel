<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

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

//Route::get('/', function () {
    //return view('welcome');
//});

//Route::get('/hello', function () {
    //return "Hello World!";
//});

//Route::get('/hello/{id}/{name}', function ($id, $name) {
    //return "#$id: Hello $name!";
//});

//Route::get('/about', function () {
    //return view('about');
//});

Route::get('/', [PagesController::class, 'index']);
Route::get('/services', [PagesController::class, 'services']);

Route::get('/about', [PagesController::class, 'about']);
//Route::get('/about', 'App\Http\Controllers\PagesController@about');
