<?php

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

Route::get('post/create',[PostController::class, 'create'] )
->name('create');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
