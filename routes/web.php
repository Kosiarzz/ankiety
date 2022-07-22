<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\PollController::class, 'index'])->name('poll.index');
Route::get('/ankieta/nowa', [App\Http\Controllers\PollController::class, 'create'])->name('poll.create');
Route::get('/ankieta/edycja/{poll}', [App\Http\Controllers\PollController::class, 'edit'])->name('poll.edit');
Route::post('/ankieta/aktualizacja', [App\Http\Controllers\PollController::class, 'update'])->name('poll.update');
Route::post('/ankieta/dodawanie', [App\Http\Controllers\PollController::class, 'store'])->name('poll.store');
Route::delete('ankieta/usuwanie/{id}', [App\Http\Controllers\PollController::class, 'destroy'])->name('poll.destroy');
Route::post('ankieta/status/{id}/{status}', [App\Http\Controllers\PollController::class, 'status'])->name('poll.status');