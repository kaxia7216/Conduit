<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ArticleController::class, 'showArticles']);

Route::get('/home', [ArticleController::class, 'showArticles']);

//記事の詳細、コメントを表示
Route::get('/article/{article_id}', [ArticleController::class, 'pickUpArticle']);

//記事の編集画面へ
Route::get('/edit/{article_id}', [ArticleController::class, 'forEditArticle']);

//記事の編集
Route::post('/edit/{article_id}', [ArticleController::class, 'editArticle']);

//記事の新規作成画面へ
Route::get('/create', [ArticleController::class, 'forCreateArticle']);

//記事の新規作成
Route::post('/create', [ArticleController::class, 'createArticle']);

//記事の削除
Route::get('/delete/{article_id}', [ArticleController::class, 'deleteArticle']);
