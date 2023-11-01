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
use App\Http\Controllers\InfoController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\LinkMovieController;
use App\Http\Controllers\LeechMovieController;
use App\Http\Controllers\RedisController;
use App\Http\Controllers\LoginSocialiteController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

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
Route::get('/filter', [IndexController::class, 'filter'])->name('filter');
Route::get('post/chinh-sach-rieng-tu', [IndexController::class, 'privacy_policy'])->name('privacy-policy');
Route::get('post/dieu-khoan-su-dung', [IndexController::class, 'terms_of_use'])->name('terms-of-use');
Route::get('post/khieu-nai-ban-quyen', [IndexController::class, 'copyright_claims'])->name('copyright-claims');
Route::get('post/lien-he', [IndexController::class, 'contact'])->name('contact');
Route::get('post/ve-chung-toi', [IndexController::class, 'about_us'])->name('about-us');

Auth::routes();
Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

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
Route::get('add-episode/{id}', [EpisodeController::class, 'add_episode'])->name('add-episode');
Route::resource('movie', MovieController::class);
Route::post('/update-year-phim', [MovieController::class, 'update_year']);
Route::post('/update-moviehot', [MovieController::class, 'update_moviehot']);
Route::post('/update-topview-phim', [MovieController::class, 'update_topview']);
Route::post('/update-season-phim', [MovieController::class, 'update_season']);
Route::resource('info', InfoController::class);
Route::resource('customer', CustomersController::class);
Route::resource('linkmovie', LinkMovieController::class);
Route::resource('leech-movie', LeechMovieController::class);
Route::resource('redis', RedisController::class);

Route::post('/toggleCustomerLock/{id}', [CustomersController::class, 'toggleCustomerLock'])->name('toggleCustomerLock');

//thay đổi dữ liệu movie bằng ajax
// Route::get('/category-choose', [MovieController::class, 'category_choose'])->name('category-choose');
Route::get('/country-choose', [MovieController::class, 'country_choose'])->name('country-choose');
Route::POST('/watch-video', [MovieController::class, 'watch_video'])->name('watch-video');
Route::get('/leech-movie', [LeechMovieController::class, 'leech_movie'])->name('leech-movie');
Route::get('leech-detail/{slug}', [LeechMovieController::class, 'leech_detail'])->name('leech-detail');
Route::get('leech-episodes/{slug}', [LeechMovieController::class, 'leech_episodes'])->name('leech-episodes');
Route::post('leech-store/{slug}', [LeechMovieController::class, 'leech_store'])->name('leech-store');
Route::post('leech-episode-store/{slug}', [LeechMovieController::class, 'leech_episode_store'])->name('leech-episode-store');
Route::get('synchronize-all-movies', [LeechMovieController::class, 'synchronizeAllMovies'])->name('synchronize-all-movies');
Route::get('synchronize-all-episodes', [LeechMovieController::class, 'synchronizeAllEpisodes'])->name('synchronize-all-episodes');
Route::get('remove-episode', [LeechMovieController::class, 'checkAndRemoveDuplicateEpisodes'])->name('remove-episode');
Route::get('delete-movie', [LeechMovieController::class, 'deleteDuplicateMovies'])->name('delete-movie');
Route::get('update-image-movie', [LeechMovieController::class, 'updateImageUrls'])->name('update-image-movie');
Route::post('leech-detail-episode', [LeechMovieController::class, 'leech_detail_episode'])->name('leech-detail-episode');

Route::get('/searchMovies', [MovieController::class, 'search'])->name('searchMovies');
Route::get('/profile', [IndexController::class, 'profile'])->name('profile')->middleware('auth:customer');

Route::middleware(['customer'])->group(function () {
    //customer login facebooke, google
    Route::get('auth/google', [LoginSocialiteController::class, 'redirectToGoogle'])->name('login-to-google');
    Route::get('auth/google/callback', [LoginSocialiteController::class, 'handleGoogleCallback']);

    Route::get('auth/facebook', [LoginSocialiteController::class, 'redirectToFacebook'])->name('login-to-facebook');
    Route::get('auth/facebook/callback', [LoginSocialiteController::class, 'handleFacebookCallback']);

    Route::get('customers/login', [LoginSocialiteController::class, 'redirectToLogin'])->name('redirectToLogin');
    Route::get('customers/register', [LoginSocialiteController::class, 'redirectToRegister'])->name('redirectToRegister');
    Route::get('customers/verifyEmail/{email}', [LoginSocialiteController::class, 'verifyEmail'])->name('verifyEmail');
    Route::get('customers/forgotPassword', [LoginSocialiteController::class, 'redirectToForgotPassword'])->name('redirectToForgotPassword');
    Route::get('customers/resetPassword/{email}/{token}', [LoginSocialiteController::class, 'redirectToResetPassword'])->name('redirectToResetPassword');
    Route::get('resendCode-customers/{email}', [LoginSocialiteController::class, 'resendCode'])->name('resendCode');
    Route::post('login-customers', [LoginSocialiteController::class, 'CheckLoginCustomers'])->name('checkLogin');
    Route::post('register-customers', [LoginSocialiteController::class, 'RegisterCustomers'])->name('RegisterCustomer');
    Route::post('sendResetLinkEmail-customers', [LoginSocialiteController::class, 'sendResetLinkEmail'])->name('sendResetLinkEmail');
    Route::post('resetPassword-customers', [LoginSocialiteController::class, 'resetPassword'])->name('resetPassword');
    Route::post('checkCodeLogin-customers', [LoginSocialiteController::class, 'checkCodeLogin'])->name('checkCodeLogin');
});

Route::get('logout', [LoginSocialiteController::class, 'logout'])->name('logout');

//send mail
Route::get('send-email', [MovieController::class, 'sendEmailNewMovies'])->name('sendMail');

//site map host
Route::get('/create_sitemap', function () {
    return Artisan::call('sitemap:create');
});

//test redis
Route::get('/redis', function () {
    Redis::set('name', 'LongNguyen');
    return Redis::get('name');
});