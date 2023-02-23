<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Auth::routes();
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(NewsController::class)->group(function () {
        Route::get('/news', 'index')->name('news.index');
        Route::post('/news/publish', 'publish')->name('news.publish');
    });
});
