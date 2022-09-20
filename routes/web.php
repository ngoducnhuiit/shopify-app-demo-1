<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfiniteScrollController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', [InfiniteScrollController::class, 'index'])->middleware(['auth', 'auth.shopify'])->name('home');
// Route::group(['prefix' => 'infinitiscroll'], function () {
//     //get
//     Route::get('/', [InfiniteScrollController::class, 'index'])->middleware(['verify.shopify'])->name('infinitiscroll_index');
//     Route::get('/delete', [InfiniteScrollController::class, 'destroy'])->middleware(['verify.shopify'])->name('infinitiscroll_delete');
//     //post
//     Route::post('/', [InfiniteScrollController::class, 'store'])->name('infinitiscroll_create');
// });
// Route::get('/', function(){
//     return view('welcome');
// })->middleware(['verify.shopify'])->name('home');

Route::middleware(['verify.shopify'])->group(function(){
    Route::get('/', [App\Http\Controllers\InfiniteScrollController::class, 'index'])->name('home');
    Route::group(['prefix' => 'infinitiscroll'], function () {
        //get
        Route::get('/', [InfiniteScrollController::class, 'index'])->name('infinitiscroll_index');
        Route::get('/delete', [InfiniteScrollController::class, 'destroy'])->name('infinitiscroll_delete');
        //post
        Route::post('/', [InfiniteScrollController::class, 'store'])->name('infinitiscroll_create');
    });
});

// Route::get('/', function () {
// 	Route::get('/', 'App\Http\Controllers\HomeController@index');
// })->name('home');
// Route::get('/', 'App\Http\Controllers\HomeController@index')->middleware(['auth'])->name('home');
// Route::get('shopify', 'App\Http\Controllers\ShopifyController@index')->middleware(['auth', 'verify.shopify'])->name('home1');
// // Route::get('/', function () {
// // 	return App::call('App\Http\Controllers\HomeController@index');
// // })->middleware(['verify.shopify'])->name('home');

// Route::get('/login', function(){
//     return view('login');
// })->name('login');


// Route::middleware('verify.shopify')->group(function () {

//     Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

//     // Route::get('/home', 'HomeController@index')->name('home_menu');

// });

// Route::get('/test', function(){

//     return $shop;
// })->name('infinitiscroll_test');


// Route::get('/', function () {
//     return view('login');
// });

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/{shop?}', function () {
//     return view('welcome');
// })->middleware(['verify.shopify'])->name('home');
