<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfiniteScrollController;

Route::get('/', [InfiniteScrollController::class, 'index'])->middleware(['verify.shopify'])->name('home');
Route::group(['prefix' => 'infinitiscroll'], function () {
    Route::get('/', [InfiniteScrollController::class, 'index'])->middleware(['verify.shopify'])->name('infinitiscroll_index');
    Route::post('/', [InfiniteScrollController::class, 'store'])->name('infinitiscroll_create');
});
