<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ReservationsController;
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

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/news', [PagesController::class, 'news'])->name('news');
Route::get('/gallery', [PagesController::class, 'gallery'])->name('gallery');
Route::get('/sponsoring', [PagesController::class, 'sponsoring'])->name('sponsoring');

Route::get('/special-calls', [PagesController::class, 'activities'])->name('activities');
Route::get('/special-calls/reserve', [ReservationsController::class, 'reserve'])->name('reserve');
Route::post('/special-calls/reserve', [ReservationsController::class, 'reserveForm'])->name('reserveForm');


Route::get('/special-calls/add', [SpecialCallsController::class, 'add'])->name('addSign')
    ->middleware(['auth']);
Route::post('/special-calls/add', [SpecialCallsController::class, 'addForm'])->name('addSignForm')
    ->middleware(['auth']);

Route::get('/special-calls/edit/{id}', [SpecialCallsController::class, 'edit'])->name('edit')
    ->middleware(['auth']);
Route::post('/special-calls/edit/{id}', [SpecialCallsController::class, 'editForm'])->name('editForm')
    ->middleware(['auth']);


Route::get('/special-calls/reservations', [ReservationsController::class, 'reservations'])->name('reservations')
    ->middleware(['auth']);
Route::post('/special-calls/reservations', [ReservationsController::class, 'reservationsForm'])->name('reservationsForm')
    ->middleware(['auth']);


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

