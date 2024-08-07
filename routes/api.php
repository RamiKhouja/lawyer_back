<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\ContactController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[UserController::class, 'login'])->name('login');


Route::get('/articles',[ArticleController::class,'index'])->name('articles');
Route::get('/articles/{article}',[ArticleController::class,'show'])->name('showArticle');

Route::get('/articles/{article}/comments',[CommentController::class,'index']);
Route::post('/articles/{article}/comments',[CommentController::class,'store']);

Route::post('/contact',[ContactController::class, 'store']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[UserController::class, 'logout'])->name('logout');

    Route::post('/articles',[ArticleController::class,'store'])->name('createArticles');
    Route::post('/articles/{article}/edit',[ArticleController::class,'edit'])->name('editArticle');
    Route::delete('/articles/{article}',[ArticleController::class,'delete'])->name('deleteArticle');
    Route::delete('/articles/{article}/comments/{comment}',[CommentController::class,'delete']);

    Route::get('/contact',[ContactController::class, 'index']);
    Route::delete('/contact/{contact}',[ContactController::class, 'delete']);



});