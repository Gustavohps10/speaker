<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SoundController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('home.search');

Route::get('/sound/new', [SoundController::class, 'create'])->name('sound.create');
Route::get('/sound/youtubeVideoData', [SoundController::class, 'getYoutubeVideoData'])->name('sound.getYoutubeVideoData');
Route::resource('sound', SoundController::class)->except(['create']);