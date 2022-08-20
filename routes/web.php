<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
//admin controllers
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}', [IndexController::class, 'watch']);
Route::get('/so-tap', [IndexController::class, 'episode'])->name('so-tap');
Route::get('/year/{year}', [IndexController::class, 'year']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);
Route::get('/director/{director}', [IndexController::class, 'director']);
Route::get('/cast-movie/{cast_movie}', [IndexController::class, 'cast_movie']);
Route::get('/search', [IndexController::class, 'search'])->name('search');
Route::post('/filter-topview-phim', [MovieController::class, 'filter_topview']);
Route::post('/insert-rating', [MovieController::class, 'insert_rating']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


//route admin
Route::resource('category', CategoryController::class);
Route::post('resorting_category', [CategoryController::class, 'resorting_category'])->name('resorting');
Route::post('resorting_country', [CountryController::class, 'resorting_country'])->name('resorting');
Route::post('resorting_genre', [GenreController::class, 'resorting_genre'])->name('resorting');
Route::resource('genre', GenreController::class);
Route::resource('country', CountryController::class);
Route::resource('episode', EpisodeController::class);
Route::get('select-movie', [EpisodeController::class, 'select_movie'])->name('select-movie');
Route::resource('movie', MovieController::class);
Route::post('/update-year-phim', [MovieController::class, 'update_year']);
Route::post('/update-topview-phim', [MovieController::class, 'update_topview']);
Route::post('/update-season-phim', [MovieController::class, 'update_season']);
