<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;

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

Route::group(['middleware' => 'auth'], function (){
    Route::resource('post', PostController::class);

    Route::post('post/{post}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('post/{post}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');

});


Route::resource('/mypage', UserController::class);

Route::get('/', function () {
    return view('welcome');
});


// Route::resource('/comment', 'CommentController',['only' => ['store']]);



// コメントのRoute
// コメントの投稿処理
Route::get('/posts/{comment_id}/comments',[CommentController::class,'store']);

// 一旦確認用
Route::get('/comment/show/{post_id}', [CommentController::class,'show'])->name('comment.show');

Route::get('/comment/create', [CommentController::class,'create']);
Route::post('/comment/store', [CommentController::class,'store'])->name('comment.store');
Route::get('/comment/{comment_id}', [CommentController::class,'destroy']);



// コメント削除処理
Route::get('/comment/{comment_id}', [CommentController::class,'destroy']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
