<?php

use App\Http\Controllers\NewPostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;



Route::get('/', function () {
    return view('welcome');
});
// /test にgetメソッドで要求が来たらTestControllerクラスのtestメソッドで処理する
Route::get('/test',[TestController::class, 'test'] )
// ルート名の設定
->name('test');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('post', NewPostController::class);
    Route::get('mypost',[NewPostController::class, 'mypost'] )->name('post.mypost');
});

require __DIR__.'/auth.php';
