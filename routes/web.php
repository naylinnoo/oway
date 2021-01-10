<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('profile.view');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('/profile/update/photo', [\App\Http\Controllers\ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
});


Route::get('/home', function (){
    return redirect()->route('profile.view');
})->name('home');



