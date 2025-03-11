<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [ArticleController::class,'create'])->name('home');
Route::post('/index', [ArticleController::class,'store'])->name('articles.store');
Route::post('/index/edit/{article:id}', [ArticleController::class,'edit'])->name('articles.edit');
Route::post('/index/edit/{article:id}', [ArticleController::class,'update'])->name('articles.update');
Route::delete('/index/delete/{article:id}', [ArticleController::class,'destroy'])->name('articles.delete');

