<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [TodoController::class, 'index'])->name('todos.index');
    Route::post('/', [TodoController::class, 'store'])->name('todos.store');
    Route::patch('/{todo}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');

    Route::patch('/status/{todo}', [TodoController::class, 'changeStatus'])->name('todos.status');

    Route::patch('/tag/{todo}', [TodoController::class, 'addTag'])->name('todos.tag');
    Route::delete('/tag/{todo}/{tag}', [TodoController::class, 'deleteTag'])->name('todos.deleteTag');
});

require __DIR__.'/auth.php';
