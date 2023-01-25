<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TaskController;

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
    return view('dashboard.home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Tasks
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('tasks/create', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('tasks/{task}/edit',[TaskController::class,'edit'])->name('tasks.edit');
    Route::patch('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('tasks/{task}/completed', [TaskController::class, 'completed'])->name('tasks.completed');
    // Tags
    Route::get('tags', [TagsController::class, 'index'])->name('tags.index');
    Route::post('tags/create', [TagsController::class, 'store'])->name('tags.store');
    Route::get('tags/{tag}/edit', [TagsController::class, 'edit'])->name('tags.edit');
    Route::patch('tags/{tag}', [TagsController::class, 'update'])->name('tags.update');
    Route::delete('tags/{tag}', [TagsController::class, 'destroy'])->name('tags.destroy');
});

require __DIR__.'/auth.php';
