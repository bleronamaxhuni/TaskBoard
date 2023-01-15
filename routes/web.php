<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
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
    return view('dashboard.home');
});
Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('tasks/create', [TaskController::class, 'store'])->name('tasks.store');
Route::get('tasks/{task}/edit',[TaskController::class,'edit'])->name('tasks.edit');
Route::patch('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.update');
Route::patch('tasks/{task}/completed', [TaskController::class, 'completed'])->name('tasks.completed');