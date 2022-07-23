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

Route::redirect('/', '/ankiety');

Auth::routes();

Route::middleware(['auth','verified'])->group(function()
{
    Route::get('/ankiety', [App\Http\Controllers\PollController::class, 'index'])->name('poll.index');
    Route::get('/ankieta/nowa', [App\Http\Controllers\PollController::class, 'create'])->name('poll.create');
    Route::get('/ankieta/edycja/{poll}', [App\Http\Controllers\PollController::class, 'edit'])->name('poll.edit');
    Route::post('/ankieta/aktualizacja', [App\Http\Controllers\PollController::class, 'update'])->name('poll.update');
    Route::post('/ankieta/dodawanie', [App\Http\Controllers\PollController::class, 'store'])->name('poll.store');
    Route::delete('ankieta/usuwanie/{id}', [App\Http\Controllers\PollController::class, 'destroy'])->name('poll.destroy');
    Route::post('ankieta/status/{id}/{status}', [App\Http\Controllers\PollController::class, 'status'])->name('poll.status');
    Route::get('ankieta/statystyki/{id}', [App\Http\Controllers\PollController::class, 'stats'])->name('poll.stats');
    
    Route::get('/wpisy', [App\Http\Controllers\EntryController::class, 'index'])->name('entries.index');
    Route::delete('/wpis/usun/{id}', [App\Http\Controllers\EntryController::class, 'destroy'])->name('entries.destroy');
});

Route::get('/ankiety/{slug}', [App\Http\Controllers\EntryController::class, 'show'])->name('entry');
Route::post('/ankieta/wysylanie', [App\Http\Controllers\EntryController::class, 'store'])->name('entry.submit');