<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryController;
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
Route::get('/sponsoring', [PagesController::class, 'sponsoring'])->name('sponsoring');


Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/add', [NewsController::class, 'create'])->name('newsAdd')->middleware(['auth']);
Route::post('/news/add', [NewsController::class, 'store'])->name('newsAddForm')->middleware(['auth']);
Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('newsEdit')->middleware(['auth']);
Route::post('/news/edit/{id}', [NewsController::class, 'update'])->name('newsEditForm')->middleware(['auth']);
Route::get('/news/delete/{id}', [NewsController::class, 'destroy'])->name('newsDelete')->middleware(['auth']);


Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/gallery/add', [GalleryController::class, 'create'])->name('galleryAdd')->middleware(['auth']);
Route::post('/gallery/add', [GalleryController::class, 'store'])->name('galleryAddForm')->middleware(['auth']);
Route::get('/gallery/delete/{id}', [GalleryController::class, 'destroy'])->name('galleryDelete')->middleware(['auth']);


Route::get('/special-calls', [ReservationsController::class, 'index'])->name('activities');
Route::get('/special-calls/reserve', [ReservationsController::class, 'create'])->name('reserve');
Route::post('/special-calls/reserve', [ReservationsController::class, 'store'])->name('reserveForm');
Route::get('/special-calls/reservations', [ReservationsController::class, 'edit'])->name('reservations')->middleware(['auth']);
Route::post('/special-calls/reservations', [ReservationsController::class, 'update'])->name('reservationsForm')->middleware(['auth']);


Route::get('/special-calls/add', [SpecialCallsController::class, 'create'])->name('addSign')->middleware(['auth']);
Route::post('/special-calls/add', [SpecialCallsController::class, 'store'])->name('addSignForm')->middleware(['auth']);
Route::get('/special-calls/show/{name}', [SpecialCallsController::class, 'show']);
Route::get('/special-calls/edit/{id}', [SpecialCallsController::class, 'edit'])->name('editSign')->middleware(['auth']);
Route::post('/special-calls/edit/{id}', [SpecialCallsController::class, 'update'])->name('editSignForm')->middleware(['auth']);
Route::get('/special-calls/delete/{id}', [SpecialCallsController::class, 'destroy'])->name('deleteSign')->middleware(['auth']);


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

