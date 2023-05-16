<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('articles', ArticleController::class)->withTrashed();
Route::resource('tags', TagController::class)->withTrashed();
Route::resource('comments', CommentController::class)->withTrashed();
Route::post('/articles/{article}/comment', [CommentController::class, 'comment'])->name('article.comment');
Route::post('/articles/{article}/like', [ArticleController::class, 'like'])->name('article.like');
Route::post('/articles/{article}/view', [ArticleController::class, 'view'])->name('article.view');
