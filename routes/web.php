<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SpecialCallsController;

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

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/news', [PagesController::class, 'news'])->name('news');
Route::get('/gallery', [PagesController::class, 'gallery'])->name('gallery');
Route::get('/sponsoring', [PagesController::class, 'sponsoring'])->name('sponsoring');

Route::get('/special-calls', [SpecialCallsController::class, 'activities'])->name('activities');
Route::get('/special-calls/reserve', [SpecialCallsController::class, 'reserve'])->name('reserve');
Route::post('/special-calls/reserve', [SpecialCallsController::class, 'reserveForm'])->name('reserveForm');

Route::get('/login', [PagesController::class, 'login'])->name('login');
Route::post('/login', [PagesController::class, 'loginForm'])->name('loginForm');
Route::get('/logout', [PagesController::class, 'logout'])->name('logout');

//Route::get('/about', [PagesController::class, 'about'])->name('about');
//Route::get('/about', 'App\Http\Controllers\PagesController@about');
