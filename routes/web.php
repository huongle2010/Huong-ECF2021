<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\reviewController;
use App\Http\Controllers\watchlistController;
use App\Http\Controllers\TopController;


use Illuminate\Http\Request;



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

Route::get('/', [AnimeController::class, 'selectList']);

Route::get('/anime/{id}', [AnimeController::class, 'showReview']);





Route::get('/login', [UserController::class, 'login']);

Route::post('/login', [UserController::class, 'connextion']);

Route::get('/signup', [UserController::class, 'signup']);

Route::post('/signup', [UserController::class, 'newUsers']);

Route::post('/signout', [UserController::class, 'logout']);



Route::get('/anime/{id}/new_review', [reviewController::class, 'listReviews']);
Route::get('/anime/{id}/new_review', [reviewController::class, 'checkReview']);
Route::post('/anime/{id}/new_review', [reviewController::class, 'addReviews']);




Route::get('/anime/{id}/add_to_watch_list', [watchlistController::class, 'watchlists']);
Route::post('/anime/{id}/add_to_watch_list', [watchlistController::class, 'addtowatchlist']);


Route::get('/add_to_watch_list', [watchlistController::class, 'showWatchlist']);

Route::get('/top', [TopController::class, 'top']);
Route::get('/top', [TopController::class, 'sortList']);