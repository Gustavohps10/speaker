<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SoundController;
use App\Http\Controllers\PlaylistController;

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

Route::get('/playlist', [PlaylistController::class, 'index'])->name('playlist.index');
Route::get('/playlist/new', [PlaylistController::class, 'create'])->name('playlist.create');
Route::get('/playlist/{playlist}/edit', [PlaylistController::class, 'edit'])->name('playlist.edit');
Route::post('/playlist/add', [PlaylistController::class, 'add'])->name('playlist.add');
Route::put('/playlist/update/{playlist}', [PlaylistController::class, 'update'])->name('playlist.update');
Route::post('/playlist/destroy', [PlaylistController::class, 'destroy'])->name('playlist.destroy');
Route::post('/playlist/addsound', [PlaylistController::class, 'addSound'])->name('playlist.addsound');
Route::post('/playlist/removesound', [PlaylistController::class, 'removeSound'])->name('playlist.removesound');